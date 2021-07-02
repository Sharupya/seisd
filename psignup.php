<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css">
<link rel="stylesheet" type="text/css" href="style.css">
<style>
body  {
  background-image: url("3.jpg");
  background-color: #cccccc;
}
</style>
</head>
<body>



<div class="topnav">
  <a href="index.php">Home</a>
  <a href="#">About</a>
  <a href="signup.php">SignUp</a>
  <a href="login.php" style="float:right">Login</a>
</div>

<div class="row">
<h2 align='center'>Customer Registration Form</h2>
  <div class="container">
  <form action="signup.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-25">
      <label for="name">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="name" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="email">Email</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email" placeholder="Your email..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">Location</label>
    </div>
    <div class="col-75">
      <select id="country" name="loc">
        <option value="dhaka">Dhaka</option>
        <option value="chittagong">Chittagong</option>
        <option value="khulna">Khulna</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="mobile">Mobile No.</label>
    </div>
    <div class="col-75">
      <input type="text" id="mobile" name="mobile" placeholder="Your mobile no..">
	  </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="dob">Date of Birth</label>
    </div>
    <div class="col-75">
      <input type="date" id="dob" name="dob" >
	  </div>
  </div>
  <div class="row">
    <div class="col-25">
     
	  <label for="gender">Gender</label>
  
    </div>
    <div class="col-75">
      <input type="radio" name="gender" value="male" checked="checked"> Male<br>
	 
	  <input type="radio" name="gender" value="female" > Female<br>
	  
	  </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="image">Picture</label>
    </div>
    <div class="col-75">
      <input type="file" id="image" name="pic">
	  </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">Password</label>
    </div>
    <div class="col-75">
      <input type="password" id="pass" name="pass" placeholder="Your password..">
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit" name="submit">
  </div>
  </form>
</div>
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
	$dob=$_POST['dob'];
	$gender=$_POST['gender'];
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
	 
	
	
	$query="insert into customer values('$cus_id','$name','$loc','$gender',$mobile ,'$dob','$email','$image','$pass')";
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