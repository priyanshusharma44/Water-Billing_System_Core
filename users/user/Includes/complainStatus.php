<?php
// Connect to the database
require_once('../../../connection/config.php'); 

// Retrieve user id
require_once('../../../connection/session.php');
$user_id =  $_SESSION['uid']; 

// Retrieve complaints from the database
$sql = "SELECT c.complain_id, c.complain_text, c.complain_date, c.resolved
        FROM complain c 
        INNER JOIN user u ON c.user_id = u.user_id
        WHERE c.user_id = ?
        ORDER BY c.complain_date DESC";

// Fetch the complaints and user data
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are complaints
if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Complaints</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/newproject/assets/style.css"></link>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="w-1">Complaint ID</th>
                <th scope="col">Complaint</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php   
            while($row = $result->fetch_assoc()) {?>
                <tr>
                <td ><?php echo $row['complain_id']; ?></td>
                <td><?php echo $row['complain_text']; ?></td>
                <td><?php echo $row['complain_date']; ?></td>
                <td>
                    <?php if($row['resolved']==1): ?>
                        Resolved
                    <?php else: ?>
                        Pending
                    <?php endif; ?>
                </td>
                </tr>
           <?php }
            ?>
        </tbody>
    </table>
</div>
<?php
} else {
    echo "No complaints found.";
}

// Close the database connection
$con->close();
?>
</body>
</html>
