<?php
$username=$_SESSION['user'];
?>

<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
<div class="side-header">
    <img src="/newproject/users/reader/assets/images/logo.png" width="120" height="120" alt="reader"> 
    <h5 style="margin-top:10px;">Hello,<?php echo $username ;?> </h5>
</div>

<hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="/newproject/users/reader/index.php" ><i class="fa fa-home"></i> Dashboard</a>
    <a href="/newproject/users/reader/Includes/reader.php" ><i class="fa fa-th-large mb-2"></i> Generate Bills</a>
	<a href="/newproject/assets/logout.php"   ><i class="fa fa-users"></i> logout</a>
   
  <!---->
</div>
 
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>

