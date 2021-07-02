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

    <div class="container"><br>
      <div class="card text-white bg-dark mb-8" style="max-width: 50rem;">
        <div class="card-header">Orders</div>
          <div class="card-body">
            <h5 class="card-title">Customer Orders</h5>
            <form action="discount.php" method="POST">

                <div class="form-group">
                    <label>Discount</label>
                    <input type="number" class="form-control" name="discount" min="10" required="required"/>
                    <br>
                    <button id="generate" class="btn btn-success" type="button"><span class="glyphicon glyphicon-random"></span> Generate</button>
                </div>
                <div class="form-group">
                    <label>Coupon Code</label>
                    <input type="text" class="form-control" name="coupon" id="coupon" readonly required="required"/>
                    <br />
                </div>
                <div class="form-group">
                    <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                </div>
            </form>
            <?php
                require_once '../connection.php';
                if(ISSET($_POST['save'])){
                    $coupon_code = $_POST['coupon'];
                    $discount = $_POST['discount'];
                    $status = "Valid";
                    $query = mysqli_query($con, "SELECT * FROM `coupon` WHERE `coupon_code` = '$coupon_code'") or die(mysqli_error());
                    $row = mysqli_num_rows($query);
                    
                    if($row > 0){
                        echo "<script>alert('Coupon Already Use')</script>";
                        echo "<script>window.location = 'index.php'</script>";
                    }else{
                        mysqli_query($con, "INSERT INTO `coupon` VALUES('', '$coupon_code', '$discount', '$status')") or die(mysqli_error());
                        ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Coupon Generated Successfully</strong>
                        </div><?php   
                    }
                }
            ?>
          </div>
        </div>
      </div>
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#generate').on('click', function(){
            $.get("get_coupon.php", function(data){
                $('#coupon').val(data);
            });
        });
    });
    </script>
  </body>
</html>

