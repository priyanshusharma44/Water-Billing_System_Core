<?php
require_once('../../../connection/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form is submitted, handle insertion of reader details

    // Retrieve admin ID from session
    $admin_id = $_SESSION['aid'];

    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Insert reader details into the database
    $sql = "INSERT INTO meter_reader (admin_id, username, email, password, phone_number) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("issss", $admin_id, $username, $email, $password, $phone);

    if ($stmt->execute()) {
        // Data inserted successfully, display an alert message
        echo '<script>';
        echo "var readerId = '{$stmt->insert_id}';";
        echo "var readerEmail = '{$email}';";
        echo "var readerPassword = '{$password}';";
        echo "alert('Reader ID: ' + readerId + '\\nEmail: ' + readerEmail + '\\nPassword: ' + readerPassword);";
       // echo "window.location.reload();"; // Reload the page after clicking OK
       echo "window.location.href='addReader.php';"; // Reload the page after clicking OK

        echo '</script>';
    } else {
        echo "alert('Reader adding failed');";
        echo "window.location.href='addReader.php';";
       // echo "Error inserting reader details: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Display the form for adding reader details
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Reader Details</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="/newproject/users/admin/assets/css/style.css"></link>
    </head>
    
    <body>
        <?php 
         include "../adminHeader.php";
         include "../sidebar.php";
?>   

    <div class="containers">

        <div class="wrapper">
            <div class="title">Add Reader Details</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="field">
                    <input type="text" id="username" name="username" required><br><br>
                    <label for="username">Username</label>
                </div>
                <div class="field">
                    <input type="email" id="email" name="email" required><br><br>
                    <label for="email">Email</label>
                </div>
                <div class="field">
                    <input type="password" id="password" name="password" required><br><br>
                    <label for="password">Password</label>
                </div>
                <div class="field">
                    <input type="text" id="phone" name="phone" required><br><br>
                    <label for="phone">Phone Number</label>
                </div>
                <div class="field">
                    
                    <button type="submit" class="submit button">Submit</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>
<!--</div>-->
    <script type="text/javascript" src="../assets/js/script.js"></script>
    
    </body>
    </html>
    <?php
}
?>
