<?php
   session_start();
   if($_SESSION['admin_login_status']!="loged in" and ! isset($_SESSION['user_id']) )
    header("Location:../index.php");
   
   if(isset($_GET['sign']) and $_GET['sign']=="out") {
	$_SESSION['admin_login_status']="loged out";
	unset($_SESSION['user_id']);
   header("Location:../index.php");    
   }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
body  {
  background-color: #404040;
}
</style>
</head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
      <a class="navbar-brand" href="home.php">Home</a>
      <div class="container-fluid" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="addproduct.php">Add Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="store.php">Store</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="corder.php">Customer Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="discount.php">Generate Discount</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">Customer List</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <!-- <li class="nav-item">
            <a class="nav-link btn btn-info btn-sm" href="changepass.php" >Change Password</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link btn btn-danger btn-sm" href="?sign=out">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container"><br><br>
      <div class="card text-white bg-dark mb-8" style="max-width: 70rem;">
          <div class="card-body">
            <h1 class="display-2 card-title text-center">Admin Home</h1>
              
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<!-- 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="../index.php">PHOTO ZONE</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../index.php">Home</a></li>
        
        <li class="active"><a href="addproduct.php">ADD PRODUCT</a></li>
        <li class="active"><a href="store.php">STORE</a></li>
        <li class="active"><a href="user.php">USER</a></li>
        <li class="active"><a href="dis.php">discount</a></li>
         
        <li><a href="corder.php">customer order</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="changepass.php"><span class="glyphicon glyphicon-user"></span>Change Password</a></li>
        <li><a href="?sign=out"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav> -->

