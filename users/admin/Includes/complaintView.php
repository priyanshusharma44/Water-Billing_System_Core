<?php
//  Connect to the database
require_once('../../../connection/config.php'); 

// retriving admin
require_once('../../../connection/session.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="/newproject/users/admin/assets/css/style.css"></link>
    <link rel="stylesheet" href="../../../assets/style.css">
</head>
<body>
<?php 
         include "../adminHeader.php";
         include "../sidebar.php";
?>  



<?php
// Check if the resolve button is clicked to refresh
if (isset($_POST['resolve']) && isset($_POST['complaint_id'])) {
    // Update the resolve status in the database
    echo "Error updating resolve status: ";
    $complaint_id = $_POST['complaint_id'];
    $sql = "UPDATE complain SET resolved = 1 WHERE complain_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $complaint_id);
    if ($stmt->execute()) {
        // Refresh the page to reflect the changes
        header("Location: ./complaintView.php");
        exit;
    } else {
        echo "Error updating resolve status: " . $stmt->error;
    }
}

//  Retrieve complaints from the database
$sql = "SELECT c.complain_id, c.complain_text, c.complain_date, u.username ,u.email
        FROM complain c 
        INNER JOIN user u ON c.user_id = u.user_id
        WHERE c.resolved = 0
        ORDER BY c.complain_date DESC"; // fetching the complain and userdata

$result = $con->query($sql);

// Check if there are complaints
if ($result->num_rows > 0) {
    // Display complaints in a table
    ?>
<div class="container">

    <h2>Complaints</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Complaint ID</th>
                <th>User</th>
                <th>Complaint</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['complain_id'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['complain_text'] ?></td>
                    <td><?= $row['complain_date'] ?></td>
                    <td>
                        <form action='' method='post'>
                            <input type='hidden' name='complaint_id' value='<?= $row['complain_id'] ?>'>
                            <input class="btn btn-primary" type='submit' name='resolve' value='Resolve'>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
        <?php
} else {
    echo "No unresolved complaints found.";
}

// Close the database connection
$con->close();
?>
   <script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>
