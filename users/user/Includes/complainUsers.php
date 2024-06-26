<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    
        .hidden {
            display: none;
        }
    </style>
    
</head>
<body>
<?php 
         require_once('../../../connection/config.php'); 
        // Retrieve username for side bar
         require_once('../../../connection/session.php');
         include "../userHeader.php";
         include "../sidebar.php";
?> 
    <div class="containers">
        <div class="complainWrapper">
    
            <button class="AddComplainButton" onclick="toggleComplaintForm()">Add Complaint</button>
            <br>
            
            <!-- Button to toggle complaint form visibility -->
            
            <!-- Complaint submission form -->
            <form id="complaintForm" action="complainUser.php" method="post" class="hidden">
                
                <textarea id="complaint" name="complaint" placeholder="write complain" required></textarea><br>
                <input type="submit" value="Submit Complaint">
                
            </form>
            <div class="title"> Complaint status</div>
        <div>
                <br>
             
                <?php
    // Include the PHP code to display complaint status
    require_once('complainStatus.php');
    
    ?>
    </div>    
</div>
</div>
<script>
        // Function to toggle visibility of complaint form
        function toggleComplaintForm() {
            var complaintForm = document.getElementById('complaintForm');
            complaintForm.classList.toggle('hidden');
        }
    </script>
     <script type="text/javascript" src="../assets/js/script.js"></script>
 
    
</body>
</html>

<