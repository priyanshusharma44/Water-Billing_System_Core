

<?php
// Include your database connection file here
require_once('../../../connection/config.php');


// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the reading ID from the form data
    $reading_id = $_POST['reading_id'];

    // Perform deletion from the bill table
    $delete_bill_sql = "DELETE FROM bill WHERE reading_id = '$reading_id'";

    // Perform deletion from the meter_reading table
    $delete_reading_sql = "DELETE FROM meter_reading WHERE reading_id = '$reading_id'";

    // Perform the deletions
    if ($con->query($delete_bill_sql) === TRUE && $con->query($delete_reading_sql) === TRUE) {
        // Redirect back to the admin view page after deletion
        header("Location: billsViewAdmin.php");
        exit();
    } else {
        // Handle errors if deletion failed
        echo "Error deleting records: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>
