<?php
   session_start();
   // Cart implementation code
   if(isset($_POST['add']))
   {
	   if(isset($_SESSION['cart']))  
	   {
		 $item_array_id=array_column($_SESSION['cart'],'item_id'); 
 		 if(!in_array($_GET['id'],$item_array_id))
		 {
			 $count=count($_SESSION['cart']);
			 $item_array= array ( 
		   'item_id' => $_GET['id'],
		   'item_name' => $_POST['hname'],
		   'item_price' => $_POST['hprice'],
		   'item_q' => $_POST['quantity']
		   );
			$_SESSION['cart'][$count]=$item_array; 
		 }
		 else
		 {
			 echo "<script>alert('Item already added')</script>";
			 echo "<script>window.location='product.php'</script>";
		 }
	   }	
       else
	   {
		   $item_array= array ( 
		   'item_id' => $_GET['id'],
		   'item_name' => $_POST['hname'],
		   'item_price' => $_POST['hprice'],
		   'item_q' => $_POST['quantity']
		   );
		   $_SESSION['cart'][0]=$item_array;
	   }		   
   }
   // Item Remove from cart
   if(isset($_GET['action']) and $_GET['action'] == 'delete')
   {
	  foreach ($_SESSION['cart'] as $keys => $values)
	  {
		  if($values['item_id'] == $_GET['id'])
		  {
			  unset($_SESSION['cart'][$keys]);
		  }
	  }		  
   }
   // Logout code
   if($_SESSION['customer_login_status']!="loged in" and ! isset($_SESSION['cus_id']) )
    header("Location:../index.php");
   
   if(isset($_GET['sign']) and $_GET['sign']=="out") {
	$_SESSION['customer_login_status']="loged out";
	unset($_SESSION['cus_id']);
	unset($_SESSION['cart']);
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
            <a class="nav-link" href="product.php">Show Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="offer.php">Offer</a>
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

  	<div class="container">
	  	<br><br>
		<div class="card text-white bg-dark mb-8" style="max-width: 80rem;">
			<div class="card-body">
				<form action="product.php" method="post">
					<div class="row">
						<div class="col-5"></div>
						<div class="form-group ">
							<select class ="form-control" name="catg">
								<option value="">-Select a Category-</option>
								<?php
								include("../connection.php");
								$sql="select distinct ptype from product";
								$r=mysqli_query($con,$sql);
									while($row=mysqli_fetch_array($r))
									{
										$type=$row['ptype'];
										echo "<option value='$type'>$type</option>";
									}
								?>
							</select>
						</div>&emsp;
						<div class="form-group">
							<input class="btn btn-primary" type="submit" value="GO" name="go">
						</div>
					</div> 
				</form>
				<hr>
				<?php
				include("../connection.php");
				if(isset($_POST['go']))
				{
					$c=$_POST['catg'];
					
					$query="select * from product,store where product.p_id=store.p_id and product.ptype='$c'";
					$r=mysqli_query($con,$query);
					echo "<table class= 'table table-striped table-dark'  id='customers'> <thead>";
					echo "<tr>
					<th>Product Name</th>
					<th>Product Type</th>
					<th>Brand Name</th>
					<th>Product Price</th>
					<th>Product Image</th>
					<th>Add quantity</th>
					<th>Action</th></thead>
					<tbody></tr>";
					while($row=mysqli_fetch_array($r))
					{
						$pid=$row['p_id'];
						$image=$row['image'];
						$pname=$row['pname'];
						$type=$row['ptype'];
						$brand=$row['brandname'];
						$price=$row['sellingPrice'];
						echo "<form action='product.php?action=add&id=$pid' method='post'>";	
						echo "<tr>
						<td>$pname</td><td>$type</td><td>$brand</td><td>$price</td>
						<td><img src='../uploadedimage/$image' height='50px' width='50px'></td>
						<td><input class='form-control' type='text' value='1' name='quantity'>
						<input type='hidden' value='$pname' name='hname'>
						<input type='hidden' value='$price' name='hprice'>
						</td>
						<td><input class='btn btn-success' type='submit' value='Add to cart' name='add'></td>
						</tr>";
						echo "</form>";
					}
					echo "<tbody></table>";
				}
				?>
			<hr>
			<h2 class="display-3">Product List</h2>
			<div class="container">
			<div class="row">
				<?php
					require '../connection.php';
					$query = mysqli_query($con, "SELECT * FROM `product`");
					while($fetch = mysqli_fetch_array($query)){ ?>
					<div class="card text-white bg-secondary " style="width: 18rem;">
						<img class="card-img-top" width="150px" height="150px" src="../uploadedimage/<?php echo $fetch['image']?>" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-title"><?php echo $fetch['pname']?></h5>
							<p class="card-text">Price : <strong> <?php echo number_format($fetch['bprice'])?></strong></p>
							<a href="purchase.php?p_id=<?php echo $fetch['p_id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart"></span> Purchase</a>
						</div>
					</div>&emsp;
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
 

