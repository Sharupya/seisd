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
      <div class="card text-white bg-dark mb-8" style="max-width: 40rem;">
        <div class="card-header">Additon</div>
          <div class="card-body">
            <h5 class="card-title">Add New Product</h5>
            <form action="addproduct.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <!-- <div class="col-25"> -->
                  <!-- <label for="name">Product ID</label> -->
                <!-- </div> -->
                <!-- <div class="col-75"> -->
                  <input class = "form-control" type="text" id="pid" name="pid" placeholder="product id..">
                <!-- </div> -->
              </div>
              <div class="form-group">
                <!-- <div class="col-25"> -->
                  <!-- <label for="email">Product Name</label> -->
                <!-- </div> -->
                <!-- <div class="col-75"> -->
                  <input class = "form-control" type="text" id="pname" name="pname" placeholder="product name..">
                <!-- </div> -->
              </div>
              <div class="form-group">
                <!-- <div class="col-25"> -->
                  <!-- <label for="country">Product Type</label> -->
                <!-- </div> -->
                <!-- <div class="col-75"> -->
                  <select class="form-control" id="ptype" name="ptype">
                    <option selected value="">-Select A Product Type-</option>
                    <option value="urban">urban</option>
                    <option value="street">Street</option>
                    <option value="wildlife">wildlife</option>
                  </select>
                <!-- </div> -->
              </div>
              <div class="form-group">
                <!-- <div class="col-25"> -->
                  <!-- <label for="bname">Brand Name</label> -->
                <!-- </div> -->
                <!-- <div class="col-75"> -->
                  <input class = "form-control" type="text" id="bname" name="bname" placeholder="Brand name..">
                <!-- </div> -->
              </div>
            
              <div class="form-group">
                <!-- <div class="col-25"> -->
                  <!-- <label for="bprice">Buying Price</label> -->
                <!-- </div> -->
                <!-- <div class="col-75"> -->
                  <input class = "form-control" type="text" id="bprice" name="bprice" placeholder="Buying Price..">
                <!-- </div> -->
              </div>
            
              <div class="form-group">
                <!-- <div class="col-25"> -->
                  <!-- <label for="image">Product Image</label> -->
                <!-- </div> -->
                <!-- <div class="col-75"> -->
                  <input class = "form-control" type="file" id="image" name="pic">
                <!-- </div> -->
              </div>
              
              <div class="form-group">
                <input class = "btn btn-info" type="submit" value="Add" name="submit">
              </div>
            </form>
            <?php
              include("../connection.php");
              if(isset($_POST['submit']))
              {
                $pid=$_POST['pid'];
                $pname=$_POST['pname'];
                $ptype=$_POST['ptype'];
                $bname=$_POST['bname'];
                $bprice=$_POST['bprice'];
                
                //image upload code
                $ext= explode(".",$_FILES['pic']['name']);
                  $c=count($ext);
                  $ext=$ext[$c-1];
                  $date=date("D:M:Y");
                  $time=date("h:i:s");
                  $image_name=md5($date.$time.$pid);
                  $image=$image_name.".".$ext;
                
                
                
                $query="insert into product values('$pid','$pname','$ptype','$bname',$bprice,'$image')";
                if(mysqli_query($con,$query))
                {
                  if($image !=null){
                    move_uploaded_file($_FILES['pic']['tmp_name'],"../uploadedimage/$image");
                      }?>
                      <div class="alert alert-success" role="alert">
                         <strong>Product Inserted Successfully</strong>
                      </div><?php                        
                  }
                else
                {
                  echo "error!".mysqli_error($con);
                }
              }
              ?>
          </div>
        </div>
      </div>
    </div>
    <br>
  </body>
</html>

