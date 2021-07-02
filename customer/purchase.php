<?php
   session_start();
   if($_SESSION['customer_login_status']!="loged in" and ! isset($_SESSION['cus_id']) )
    header("Location:../index.php");
   
   if(isset($_GET['sign']) and $_GET['sign']=="out") {
	$_SESSION['customer_login_status']="loged out";
	unset($_SESSION['cus_id']);
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
<body>
    <div class="container"><br>
        <div class="card text-white bg-dark mb-8" style="max-width: 40rem;">
            <div class="card-body">
            <h3 class="display-4 card-title text-center">Your Purchase</h3>
            <?php
                require '../connection.php';
                $query = mysqli_query($con, "SELECT * FROM `product` WHERE `p_id` = '$_REQUEST[p_id]'");
                $fetch = mysqli_fetch_array($query);
            ?>
                <form method='post'>
                    <img src="../uploadedimage/<?php echo $fetch['image']?>" width="100%" height="300px"/>
                    <center><h3><?php echo $fetch['pname']?></h3></center>
                    <center><h4><strong>Price:</strong><?php echo number_format($fetch['bprice'])?></h4></center>
                    <div class="form-group">
                        <h4 class="text-warning">*Optional</h4>
                        <label>Coupon Code</label>
                        <input class="form-control" type="text" id="coupon"/>
                        <input type="hidden"  value="<?php echo $fetch['bprice']?>" id="price"/>
                        <br style="clear:both;"/>
                        <button class="btn btn-primary" id="activate">Activate Code</button>
                        <br style="clear:both;"/>
                        <div id="result"></div>
                        <br style="clear:both;"/>
                        <label>Quantity</label>
                        <input class="form-control" type="number" name="qty"/>
                    </div>
                    <div class="form-group">
                        <label>Total Price</label>
                        <input class="form-control" name="price" type="number" value="<?php echo $fetch['bprice']?>" id="total" readonly="readonly" lang="en-150"/>
                    </div>
                    <div class="form-group">
                        <input class = "btn btn-info" type="submit" value="Submit your Order" name="corder">
                    </div>
                </form>
                <?php
                // Save the orders in database
                if(isset($_POST['corder']))
                {
                    
                    $num=rand(10,1000);
                    $order_id="O-".$num;
                    $order_date=date("Y-m-d");
                    $cus_id=$_SESSION['cus_id'];
                    $qty = $_POST['qty'];
                    $total = $_POST['qty']*$_POST['price'];
                    $sqlorder="insert into customer_order values('$order_id','$cus_id','$_REQUEST[p_id]', '$qty','$total','$order_date',0)";
                    if(mysqli_query($con,$sqlorder)){ ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Purchase Successfull</strong>
                        </div>
                    <?php }
                    
                    unset($_SESSION['cart']);
                }
                ?>	
            </div>
        </div>
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        $(document).ready(function(){
            $('#activate').on('click', function(e){
                e.preventDefault();
                var coupon = $('#coupon').val();
                var price = $('#price').val();
                if(coupon == ""){
                    alert("Please enter a coupon code!");
                }else{
                    $.post('get_discount.php', { coupon: coupon, price: price }, function(data){
                        if(JSON.parse(data)=='0'){
                            $('#total').val(price);
                            $('#result').html("<br><div class='alert alert-danger' role='alert'><strong>Invalid Coupons</strong></div>");
                        }else{
                            var json = JSON.parse(data);
                            $('#result').html("<br><div class='alert alert-success' role='alert'><strong>"+json.discount+"% Off</strong></div>");
                            $('#total').val(json.price);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>