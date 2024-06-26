<?php
require_once('../../../connection/config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_POST["userId"];
    $prevReading = $_POST["prevReading"];
    $prevDate = $_POST["prevDate"];
    $currReading = $_POST["currReading"];
    $currentDate = date("Y-m-d"); // Get current date
    
    // Check if units consumed is negative
    $unitsConsumed = $currReading - $prevReading;
    if ($unitsConsumed < 0) {
        echo '<script>';
        echo 'alert("Error: Units consumed cannot be negative.");';
        echo 'window.location.href = "reader.php";'; // Redirect back to the reader page
        echo '</script>';
        exit(); // Exit the script to prevent further execution
    }

    // Calculate due date (30 days after the current reading date)
    $dueDate = date('Y-m-d', strtotime($currentDate . ' +30 days'));

    // Update meter reading in database
    $query = "INSERT INTO meter_reading (user_id, previous_reading_date, previous_reading_value, current_reading_date, current_reading_value) VALUES (?, ?, ?, ?, ?)";
    $statement = $con->prepare($query);
    $statement->bind_param('isssd', $userId, $prevDate, $prevReading, $currentDate, $currReading);
    $statement->execute();

    // Calculate bill amount based on tariff tiers
    $query = "SELECT tariff_id, minimum_usage, maximum_usage, unit_price, base_fee FROM tariff";
    $result = $con->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tariffId = $row['tariff_id'];
            $minUsage = $row['minimum_usage'];
            $maxUsage = $row['maximum_usage'];
            $unitPrice = $row['unit_price'];
            $baseFee = $row['base_fee'];

            // Check if the units consumed fall within the range of this tariff tier
            if ($unitsConsumed >= $minUsage && $unitsConsumed <= $maxUsage) {
                // Calculate total bill amount
                $billAmount = $baseFee + ($unitsConsumed * $unitPrice);

                // Insert bill details into the database
                $query = "INSERT INTO bill (user_id, reading_id, tariff_id, units, total_amount, due_date) VALUES (?, LAST_INSERT_ID(), ?, ?, ?, ?)";
                $statement = $con->prepare($query);
                $statement->bind_param('iiids', $userId, $tariffId, $unitsConsumed, $billAmount, $dueDate);
                $statement->execute();

                // Check if the bill was inserted successfully
                if ($statement->affected_rows > 0) {
                    // Redirect back to the reader page after successful update
                    echo '<script>';
                    echo 'alert("Meter reading and bill updated successfully!");';
                    echo 'window.location.href = "reader.php";';
                    echo '</script>';
                    exit(); // Exit the script to prevent further execution
                } else {
                    echo "Failed to update bill details.";
                }
            }
        }
    } else {
        echo "No tariff details found.";
    }
}

// Close connection
$con->close();
?>