<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<style>
body {
  background-color:#404040;
  -webkit-font-smoothing: antialiased;
  font: normal 14px Roboto,arial,sans-serif;
}

.container {
    padding: 25px;
    position: fixed;
}

.form-login {
    background-color: #787878;
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
}

h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}

.form-control {
    border-radius: 10px;
}

.wrapper {
    text-align: center;
}

</style>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">Photo Market</a>
        </div>
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contuct Us</a>
        </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link btn btn-info btn-sm" href="signup.php" target="_blank">Sign Up</a>
        </li>
        </ul>
    </div>
    </nav>
<div class="container">
<form action="login.php" method="post">
<div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-md-6">
            <div class="form-login">
            <h4>Login</h4>
            
            <input type="text" name="id" class="form-control input-sm chat-input" placeholder="User Id" />
            </br>
            <input type="password" name="pass"  class="form-control input-sm chat-input" placeholder="Password" />
            </br>
            <input type="submit" name="login" class="btn btn-primary col-12" value="Login">
        </div>
        <div class="col-4"></div>
    </div>
</div>
</form>
</div>

 



</body>
</html>

<?php
include("connection.php");
if(isset($_POST['login']))
{
	$id=$_POST['id'];
	$pass=$_POST['pass'];

	$sql="select userid,password from admin where userid='$id' and password='$pass'";
  $sql1="select cus_id,password from  customer where cus_id='$id' and password='$pass'";
            $r=mysqli_query($con,$sql);
            $r1=mysqli_query($con,$sql1);
            if(mysqli_num_rows($r)>0)
            {
                $_SESSION['user_id']=$id;
                $_SESSION['admin_login_status']="loged in";
                header("Location:admin/home.php");
            }
            
            else if(mysqli_num_rows($r1)>0)
            {
              $single = mysqli_fetch_assoc($r1);
                $_SESSION['cus_id']=$single['cus_id'];
                $_SESSION['customer_login_status']="loged in";
                header("Location:customer/home.php");
            }
            else
            {
                echo "<p style='color: red;'>Incorrect UserId or Password</p>";
            }
	
}
?>