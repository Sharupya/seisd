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
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">Photomarket</a>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">PHP - Generate Coupon Code</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<a href="index.php" class="btn btn-success">Back</a>
		<br />
		<h4>Purchase Product</h4>
		<?php
			require '../connection.php';
			$query = mysqli_query($con, "SELECT * FROM `product` WHERE `p_id` = '$_REQUEST[p_id]'");
			$fetch = mysqli_fetch_array($query);
		?>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<img src="<?php echo $fetch['image']?>" width="100%" height="300px"/>
			<center><h3><?php echo $fetch['pname']?></h3></center>
			<center><h4>&#8369;<?php echo number_format($fetch['bprice'])?></h4></center>
			<div class="form-group">
				<h4 class="text-warning">*Optional</h4>
				<label>Coupon Code</label>
				<input class="form-control" type="text" id="coupon"/>
				<input type="hidden" value="<?php echo $fetch['bprice']?>" id="price"/>
				<div id="result"></div>
				<br style="clear:both;"/>
				<button class="btn btn-primary" id="activate">Activate Code</button>
			</div>
			<div class="form-group">
				<label>Total Price</label>
				<input class="form-control" type="number" value="<?php echo $fetch['bprice']?>" id="total" readonly="readonly" lang="en-150"/>
			</div>
			<div> <center><a href="corder.php?p_id=<?php echo $fetch['p_id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart"></span> Purchase</a></center></div>
		</div>
		
	</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script>
	$(document).ready(function(){
		$('#activate').on('click', function(){
			var coupon = $('#coupon').val();
			var price = $('#price').val();
			if(coupon == ""){
				alert("Please enter a coupon code!");
			}else{
				$.post('get_discount.php', {coupon: coupon, price: price}, function(data){
					if(data == "error"){
						alert("Invalid Coupon Code!");
						$('#total').val(price);
						$('#result').html('');
					}else{
						var json = JSON.parse(data);
						$('#result').html("<h4 class='pull-right text-danger'>"+json.discount+"% Off</h4>");
						$('#total').val(json.price);
					}
				});
			}
		});
	});
</script>
</body>
</html>