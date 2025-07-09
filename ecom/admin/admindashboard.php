<?php


session_start();
if(!isset($_SESSION["admineid"]))
{
  header("location:../login.php");
}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
  <?php include("../include/allheadercdn.php"); ?>
</head>
<body>


  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#addproduct">Add Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#manageuser">Manage User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" href="../logout.php">Logout</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="addproduct">

 <?php include("addproduct.php"); ?> 

  </div>
  <div class="tab-pane container fade" id="manageuser">
    

    <?php include("manageuser.php"); ?>


  </div>
  <div class="tab-pane container fade" id="menu2">...</div>
</div>





<?php include("../include/allfooterlinks.php"); ?>
</body>
</html>