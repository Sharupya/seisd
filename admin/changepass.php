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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="index.css">
<link rel="stylesheet" type="text/css" href="../signup.css">
<link rel="stylesheet" type="text/css" href="../style.css">
<style>
body  {
  background-image: url("../bg.jpg");
  background-color: #cccccc;
}
</style>
</head>
<body>

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
         
        <li><a href="corder.php">customer order</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="changepass.php"><span class="glyphicon glyphicon-user"></span>Change Password</a></li>
        <li><a href="?sign=out"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="row">
<h2 align='center'>Change Your Password</h2>
  <div class="container">
  <form action="changepass.php" method="post">
    <div class="row">
    <div class="col-25">
      <label for="pass">Old Password</label>
    </div>
    <div class="col-75">
      <input type="password" id="pass" name="opass" placeholder="Your old password..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">New Password</label>
    </div>
    <div class="col-75">
      <input type="password" id="pass" name="npass" placeholder="Your new password..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">Confirm Password</label>
    </div>
    <div class="col-75">
      <input type="password" id="pass" name="cpass" placeholder="Retype Your password..">
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Change Password" name="submit">
  </div>
  </form>
</div>
<?php
if(isset($_POST['submit']))
{
	include("../connection.php");
    $id=$_SESSION['user_id'];
    $opass=$_POST['opass'];
    $npass=$_POST['npass'];
	$cpass=$_POST['cpass'];
	if($npass==$cpass)
	{
	$sql="select password from admin where password='$opass' and userid='$id'";
    $r=mysqli_query($con,$sql);
    if(mysqli_num_rows($r)>0)
    {
       $sql1="update admin set password='$npass' where userid='$id'"; 
       if(mysqli_query($con,$sql1))
       {
         echo "Password Changed Successfully!";
       }  
    }
	else
	{
		echo "Old password does not match";
	}
	}
    else
    {
        echo "New password does not match with Confirm password";
    }
}

?>

</body>
</html>
