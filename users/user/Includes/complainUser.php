<?php
// Step 1: Connect to the database
require_once('../../../connection/config.php'); 

// Step 2: Retrieve userid through session
require_once('../../../connection/session.php'); 
$user_id =  $_SESSION['uid']; 

//fetching complain text
$complaint = $_POST["complaint"];

$sql = "INSERT INTO complain (user_id,complain_text, complain_date) VALUES (?,?, NOW())";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("is", $user_id,$complaint);

    if ($stmt->execute()) {
        echo "Complaint submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    // Close the database connection
    $stmt->close();
    $con->close();
    header("location:complainusers.php");

?>