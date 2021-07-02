<?php
   session_start();
   if(empty($_SESSION['cart']))
   {
	   $_SESSION['cart']=array();
   }

   if($_SESSION['customer_login_status']!="loged in" and ! isset($_SESSION['user_id']) )
    header("Location:../index.php");
   
   if(isset($_GET['sign']) and $_GET['sign']=="out") {
	$_SESSION['customer_login_status']="loged out";
	unset($_SESSION['user_id']);
   header("Location:../index.php");    
   }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="table.css">
<style>
 body  {
  background-image: url("background.jpg");
  background-color: #cccccc;
}
</style>
</head>
<body>

<div class="header">
  <h1>PHOTOZONE</h1>
</div>

<div class="topnav">
  <div class="topnav">
  <a href="home.php">Home</a>
  <a href="product.php">All Products</a>
  <a href="?sign=out" style="float:right">Logout</a>
</div>
</div>

<div class="row">

  <div class="container">

  <form action="corder.php" method="post">
  <div class="row">
  
  <div class="row">
    <div class="col-25">
	<label for="pid">Quantity</label>
    </div>
    <div class="col-75">
       <input type='text' value='' name='quantity'>
  </div>
  </div> 
  
  <div class="row">
    <input type="submit" value="Add to Cart" name="add">
  </div>
  </form>
</div>
<?php
include("../connection.php");
if(isset($_POST['add']))
{
	$pid=$_SESSION['pid'];
    $q=$_POST['quantity'];
	$b=array("productid"=>"$pid","quantity"=>$q);
    array_push($_SESSION['cart'],$b);
	$max=sizeof($_SESSION['cart']);
for($i=0; $i<$max; $i++) { 

while (list ($key, $val) = each ($_SESSION['cart'][$i])) { 
echo "$key -> $val ,"; 
} // inner array while loop
echo "<br>";
} // outer array for loop
}
?>
</div>


</body>
</html>

