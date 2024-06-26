<!DOCTYPE html>
<html>
<head>
  <title>Meter reader</title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="/newproject/users/reader/assets/css/style.css"></link>
  </head>
</head>
<body >
    
    
		   
		   
<?php 
    require_once('../../connection/config.php'); 
    require_once('../../connection/session.php'); 
    include "./readerHeader.php"; 
    include "./sidebar.php"; 
    if ($logged == false) {
         header("Location:../../index.php");
    }
?>


       

    <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                  <a href="Includes/reader.php" style="text-decoration:none;">

                      <i class="fa fa-users  mb-2" style="font-size: 70px; " ></i>
                      <h4 style="color:white;">Generate Bills </h4>
                      <h5 style="color:white;">
                    </a>
                    <?php
					
                    ?></h5>
                </div>
            </div>
           
         
        </div>
        
    </div>
       
            
       


    <script type="text/javascript" src="/newproject/users/reader/assets/js/script.js"></script>
    
</body>
 
</html>