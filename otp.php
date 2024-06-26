<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the entered OTP from the form
    $enteredOTP = $_POST['first'] . $_POST['second'] . $_POST['third'] . $_POST['fourth'];

    // Retrieve the OTP stored in the session
    $storedOTP = implode($_SESSION['otp']); //array lai single string  ma converted here

    // Check if the entered OTP matches the stored OTP
    if ($enteredOTP == $storedOTP) {
        // Redirect to login.php if OTP matches
        header("Location: login.php");
        exit();
    } else {
        // Display error message if OTP doesn't match
        $errorMessage = "Incorrect OTP. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<link rel="stylesheet" href="otp.css">

<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <form action="otp.php" method="post">
            <input type="number" name="first" required>
            <input type="number" name="second" required>
            <input type="number" name="third" required>
            <input type="number" name="fourth" required><br>
            <button type="submit">Verify OTP</button>
        </form>
        <?php if(isset($errorMessage)) echo "<p class='error'>$errorMessage</p>"; ?>
    </div>
</body>

</html>