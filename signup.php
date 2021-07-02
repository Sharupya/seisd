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
<style>
body  {
  background-color: #404040;
  -webkit-font-smoothing: antialiased;
  font: normal 14px Roboto,arial,sans-serif;

}
</style>
</head>
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
          <a class="nav-link btn btn-info btn-sm" href="login.php" target="_blank"> Login</a>
        </li>
        </ul>
    </div>
    </nav>

<div class="container">
<article class="card-body mx-auto" style="max-width: 400px;">
<h2 class="text-center text-light"><strong>Sign Up</strong></h2>
    <form action="signup.php" method="post" enctype="multipart/form-data">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="name" class="form-control" placeholder="Full name" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email">
    </div> <!-- form-group// -->
 <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-home"></i> </span>
		</div>
		<select name="loc" class="form-control">
        <option selected="">Location</option>
        <option value="Dhaka">Dhaka</option>
        <option value="Chittagong">Chittagong</option>
        <option value="Barisal">Barisal</option>
        <option value="Khulna">Khulna</option>
        <option value="Mymensingh">Mymensingh</option>
        <option value="Rajshahi">Rajshahi</option>
        <option value="Rangpur">Rangpur</option>
        <option value="Sylhet">Sylhet</option>
		</select>
	</div> <!-- form-group end.// -->

  <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
    	<input name="mobile" class="form-control" placeholder="Phone number" type="text">
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-photo"></i> </span>
		 </div>
        <input name="pic" class="form-control" placeholder="Photo" type="file">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="pass" class="form-control" placeholder="Create password" type="password">
    </div> <!-- form-group// -->                                   
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div> <!-- form-group// --> 
</form>
</article>
</div> <!-- card.// -->

</div> 

</body>
</html>

<?php
include("connection.php");
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$loc=$_POST['loc'];
	$mobile=$_POST['mobile'];
	$pass=$_POST['pass'];
	//customer id generation
	$num=rand(10,100);
	$cus_id="c-".$num;
	
	//image upload code
	$ext= explode(".",$_FILES['pic']['name']);
    $c=count($ext);
    $ext=$ext[$c-1];
    $date=date("D:M:Y");
    $time=date("h:i:s");
    $image_name=md5($date.$time.$cus_id);
    $image=$image_name.".".$ext;
	 
	
	
	$query="insert into customer values('$cus_id','$name','$loc',$mobile,'$email','$image','$pass')";
	if(mysqli_query($con,$query))
	{
		echo "Successfully inserted!";
		if($image !=null){
	                move_uploaded_file($_FILES['pic']['tmp_name'],"uploadedimage/$image");
                    }
    }
	else
	{
		echo "error!".mysqli_error($con);
	}
}
?>