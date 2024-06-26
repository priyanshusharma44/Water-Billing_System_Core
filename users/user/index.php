<!DOCTYPE html>
<html>

<head>
    <title>User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php 
    require_once('../../connection/config.php'); 
    require_once('../../connection/session.php'); 
    include "./userHeader.php";
    include "./sidebar.php";
    if ($logged==false) {
         header("Location:../../index.php");
    }
    ?>
    <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center mb-3">
                <div class="card text-center d-flex align-items-center justify-content-center p-4 w-100">
                    <a href="./Includes/billsUser.php"
                        class="text-decoration-none d-flex flex-column align-items-center">
                        <i class="fa fa-users mb-2" style="font-size: 70px;"></i>
                        <h4 style="color:white;">Bills view</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center mb-3">
                <div class="card text-center d-flex align-items-center justify-content-center p-4 w-100">
                    <a href="./Includes/billsRecord.php"
                        class="text-decoration-none d-flex flex-column align-items-center">
                        <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                        <h4 style="color:white;">Bills Record</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center mb-3">
                <div class="card text-center d-flex align-items-center justify-content-center p-4 w-100">
                    <a href="./Includes/complainUsers.php"
                        class="text-decoration-none d-flex flex-column align-items-center">
                        <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                        <h4 style="color:white;">Complaint</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>

</html>