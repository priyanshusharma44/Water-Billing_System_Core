<?php
session_start(); // Start the session

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load Composer's autoloader

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wbill";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if name, email, password, contact_num, address, and admin_id are set in the $_POST array
    if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['contact_num'], $_POST['address'], $_POST['admin_id'])) {
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $contact_num = $_POST['contact_num'];
        $address = $_POST['address'];
        $admin_id = $_POST['admin_id']; // Retrieve admin_id from the form

        // Check if email already exists
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Email already exists";
        } else {
            // Generate OTP
            $otp = rand(1000, 9999);

            // Insert user data into the database with the correct admin_id
            $sql = "INSERT INTO user (admin_id, username, email, password, otp, contact_num, address) 
                    VALUES ('$admin_id', '$username', '$email', '$password', '$otp', '$contact_num', '$address')";
            if ($conn->query($sql) === TRUE) {
                // Fetch the user ID of the newly inserted user
                $user_id = $conn->insert_id;

                // Insert initial meter reading for the new user
                $sql = "INSERT INTO meter_reading (user_id, previous_reading_date, previous_reading_value, current_reading_date, current_reading_value) 
                        VALUES ('$user_id', NOW(), 0, NOW(), 0)";
                $conn->query($sql);

                // Store OTP in session
                $_SESSION['otp'] = str_split($otp); // Convert OTP to an array for easier comparison

                // Send OTP email
                sendOTP($email, $otp);

                // Redirect to OTP verification page
                header("Location: otp.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
// Close connection
$conn->close();

// Function to send OTP email
function sendOTP($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'serjoramos4444@gmail.com'; // Update with your email
        $mail->Password = 'ymlgikngcfcnznel'; // Update with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipient
        $mail->setFrom('your_email@gmail.com', 'Your Name'); // Update with your email and name
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'OTP Verification';
        $mail->Body = 'Your OTP is: ' . $otp;

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>