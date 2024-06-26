<?php 
require_once("connection/config.php");

session_start();
if(isset($_SESSION['logged']))
{
    if ($_SESSION['logged'] == true)
    {
        if ($_SESSION['account']=="admin") {
                header("Location:users/admin/index.php");
            }
        elseif ($_SESSION['account']=="user") {
                header("Location:users/user/index.php");
            }
			elseif ($_SESSION['account']=="user") {
                header("Location:users/reader/index.php");
            }
        }
    else {
        
		header("Location:login.php");
      }  
}else {
    header("Location:login.php");
}




?>