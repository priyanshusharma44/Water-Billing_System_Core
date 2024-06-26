<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/newproject/users/admin/assets/css/style.css">
    <style>
        .card {
            height: 200px; /* Set a fixed height for the cards */
            display: flex;
            align-items: center; /* Center content vertically */
            justify-content: center; /* Center content horizontally */
            margin-bottom: 20px; /* Add some margin between cards */
        }

        .card a {
            text-decoration: none;
            color: inherit; /* Inherit text color */
        }

        .card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Add box shadow on hover */
        }
    </style>
</head>
<body>
<?php 
    require_once('../../connection/config.php'); 
    require_once('../../connection/session.php'); 
    include "./adminHeader.php";
    include "./sidebar.php";
    if ($logged==false) {
        header("Location:../../index.php");
    }
?>

<div id="main-content" class="container allContent-section py-4">
    <div class="row">
        <div class="col-sm-4"> <!-- Adjusted column size to make the boxes equal -->
            <div class="card bg-primary">
                <a href="./Includes/billsViewAdmin.php">
                    <i class="fa fa-users mb-2" style="font-size: 70px;"></i>
                    <h4 class="text-center text-white">Bills View</h4>
                </a>
            </div>
        </div>
        <div class="col-sm-4"> <!-- Adjusted column size to make the boxes equal -->
            <div class="card bg-secondary">
                <a href="./Includes/complaintView.php">
                    <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                    <h4 class="text-center text-white">Complaint View</h4>
                </a>
            </div>
        </div>
        <div class="col-sm-4"> <!-- Adjusted column size to make the boxes equal -->
            <div class="card bg-info">
                <a href="./Includes/billsRecord.php">
                    <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                    <h4 class="text-center text-white">Bill Records</h4>
                </a>
            </div>
        </div>
        <div class="col-sm-4"> <!-- Adjusted column size to make the boxes equal -->
            <div class="card bg-info">
                <a href="./Includes/addReader.php">
                    <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                    <h4 class="text-center text-white">Add Meter Reader</h4>
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/newproject/users/admin/assets/js/script.js"></script>

</body>
</html>
