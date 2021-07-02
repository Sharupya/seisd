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
<?php
	require_once '../connection.php';
	$coupon_code = $_POST['coupon'];
	$price = $_POST['price'];
	
	$query = mysqli_query($con, "SELECT * FROM `coupon` WHERE `coupon_code` = '$coupon_code' && `status` = 'Valid'");
	$count = mysqli_num_rows($query);
	$fetch = mysqli_fetch_array($query);
	$array = array();
	if($count > 0){
		$discount = $fetch['discount'] / 100;
		$total = $discount * $price;
		$array['discount'] = $fetch['discount'];
		$array['price'] = $price - $total;
		
		echo json_encode($array);
		
	}else{
		echo "error";
	}
?>