<?php

$username=$_SESSION['user'];

?>
<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <img src="/newproject/users/user/assets/images/logo.png" width="120" height="120" alt="logo"> 
        <h5 style="margin-top:10px;">Hello, <?php echo $username ;?></h5>
    </div>

    <hr style="border:1px solid; background-color:#fff; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="/newproject/users/user/index.php" ><i class="fa fa-home"></i> Dashboard</a>
    <a href="/newproject/users/user/Includes/billsUser.php" ><i class="fa fa-th-large mb-2"></i> Bills View</a>
    <a href="/newproject/users/user/Includes/billsRecord.php" ><i class="fa fa-th-large mb-2"></i> Bills Record</a>
    <a href="/newproject/users/user/Includes/complainUsers.php" ><i class="fa fa-th-large mb-2"></i> Complaint</a>
   
	<a href="/newproject/assets/logout.php" ><i class="fa fa-users"></i> logout</a>
   
  <!---->
</div>
 
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>

