<?php
// Establish MySQL connection
require_once('../../../connection/config.php'); 
require_once('../../../connection/session.php'); 
$username = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from the form
    $userId = $_POST["userId"];
   // echo "Searching for User ID: " . $userId . "<br>";

    // Fetch last meter reading for the user from the database
    $query = "SELECT current_reading_value, current_reading_date FROM meter_reading WHERE user_id = ? ORDER BY current_reading_date DESC LIMIT 1";
    $statement = $con->prepare($query);
    if ($statement === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    // If user ID exists in database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $prevReading = $row['current_reading_value'];
        $prevDate = $row['current_reading_date'];
    } else {
        // User ID not found in database
        echo '<script>';
        echo 'alert("User ID or reading does not exist!");';
        echo 'window.location.href="reader.php";';
        echo '</script>';
        exit();
    }
}

// Close connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Current Reading</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/newproject/users/reader/assets/css/style.css">
    <link rel="stylesheet" href="/newproject/assets/style.css">
</head>

<body>
    <?php 
    include "../readerHeader.php";
    include "../sidebar.php";
    ?>
    <div class="containers">
        <div class="wrapper">
            <div class="title">
                <h1>Enter Current</h1>
                <h1>Reading</h1>
            </div>
            <form action="update.php" method="POST">
                <div class="field">
                    <input type="text" id="prevReading" name="prevReading" value="<?php echo $prevReading; ?>">
                    <label for="prevReading">Previous Reading:</label>
                </div>

                <div class="field">
                    <input type="text" id="prevDate" name="prevDate" value="<?php echo $prevDate; ?>">
                    <label for="prevDate">Previous Reading Date:</label>
                </div>

                <div class="field">
                    <input type="text" id="currReading" name="currReading" required>
                    <label for="currReading">Current Reading:</label>
                </div>

                <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                <div class="field">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../assets/js/script.js"></script>

</body>

</html>