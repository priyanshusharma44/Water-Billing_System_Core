<!-- billUpdateProcess.php -->

<?php
// Include your database connection file here
require_once('../../../connection/config.php');

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data 
    $bill_id = $_POST['bill_id'];
    $payment_status = $_POST['payment_status'];
    $previous_reading_value = $_POST['previous_reading_value'];
    $previous_reading_date = $_POST['previous_reading_date'];
    $current_reading_value = $_POST['current_reading_value'];
    $current_reading_date = $_POST['current_reading_date'];
    $reading_id = $_POST['reading_id'];
    // Calculate the units and total amount
    $units= $current_reading_value - $previous_reading_value;
    $total_amount= $units * $tariff_rate;

    // Update the database with the form data
    $update_bill_sql = "UPDATE bill SET 
                        units = '$units',
                        payment_status = '$payment_status'
                        WHERE bill_id = '$bill_id'";
    
    $update_reading_sql = "UPDATE meter_reading SET 
                           previous_reading_value = '$previous_reading_value',
                           previous_reading_date = '$previous_reading_date',
                           current_reading_value = '$current_reading_value',
                           current_reading_date = '$current_reading_date'
                           WHERE reading_id = '$reading_id'";

    // Perform the updates
    if ($con->query($update_bill_sql) === TRUE && $con->query($update_reading_sql) === TRUE) {
        // Redirect back to the admin view page if updates were successful
        header("Location: billsViewAdmin.php");
        exit();
    } else {
        // Handle errors if updates failed
        echo "alert('Updating bills failed');";
        echo "window.location.href='addReader.php';";
       // echo "Error updating records: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>
