<!-- billUpdateAdmin.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Bill</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="/newproject/users/admin/assets/css/style.css"></link>
</head>
<body>
<?php 
         include "../adminHeader.php";
         include "../sidebar.php";
?>  

<?php
// Retrieve data from the first form
$bill_id = $_POST['bill_id'];
$payment_status = $_POST['payment_status'];
$previous_reading_value = $_POST['previous_reading_value'];
$previous_reading_date = $_POST['previous_reading_date'];
$current_reading_value = $_POST['current_reading_value'];
$current_reading_date = $_POST['current_reading_date'];
$reading_id = $_POST['reading_id'];
?>

<div class="containers">
<div class="wrapper">
<div class="title">

    Update Bill
</div>
    
    <form action="billUpdateProcess.php" method="post">
        <!-- Input fields pre-filled with data from the first form from billsViewAdmin hidden inputs of update -->
        <input type="hidden" name="bill_id" value="<?= $bill_id ?>">
        
        
        
        <div class="field">
            
            <input type="text" id="previous_reading_value" name="previous_reading_value" value="<?= $previous_reading_value ?>"><br>
            <label for="previous_reading_value">Previous Reading Value:</label>
        </div>
        
        <div class="field">
            <input type="date" id="previous_reading_date" name="previous_reading_date" value="<?= $previous_reading_date ?>"><br>
            <label for="previous_reading_date">Previous Reading Date:</label>
        </div>
        
        <div class="field">
            <input type="text" id="current_reading_value" name="current_reading_value" value="<?= $current_reading_value ?>"><br>
            <label for="current_reading_value">Current Reading Value:</label>
        </div>
        
        <div class="field">
            <input type="date" id="current_reading_date" name="current_reading_date" value="<?= $current_reading_date ?>"><br>
            <label for="current_reading_date">Current Reading Date:</label>
        </div>
        
        <div class="field">
        
            <input type="text" id="payment_status" name="payment_status" value="<?= $payment_status ?>"><br>
            <label for="payment_status">Payment Status:</label>
        </div>
        <input type="hidden" name="reading_id" value="<?= $reading_id ?>">
        <div class="field">
            <button class="btn btn-success" type="submit">Update</button>
        </div>
    </form>
</div>    

</div>
<script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>
