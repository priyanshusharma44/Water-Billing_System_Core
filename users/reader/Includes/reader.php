<?php
    require_once('../../../connection/config.php'); 
    require_once('../../../connection/session.php'); 
    include "../readerHeader.php";
    include "../sidebar.php";
    $username=$_SESSION['user'];

    //if ($logged==false) {
    //     header("Location:../../index.php");
    //}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meter Reading Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/newproject/users/reader/assets/css/style.css">
    </link>
    <link rel="stylesheet" href="/newproject/assets/style.css">
    </link>
</head>

<body>
    <div class="containers">
        <div class="wrapper reader">
            <div class="title">Enter Meter Reading</div>
            <form action="search.php" method="POST">
                <div class="field">
                    <input type="text" id="userId" name="userId" required>
                    <label for="userId">User ID</label>
                </div>
                <div class="field">
                    <input type="submit" value="Search">
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>


</body>

</html>