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
    <div class="container">
    
      <div class="container"><br>
        <div class="card text-white bg-dark mb-8" style="max-width: 60rem;">
          <div class="card-header">Store</div>
            <div class="card-body">
              <h5 class="card-title">Store New Product In Warehouse</h5>
                <form action="store.php" method="post">
                  <input class="btn btn-info" type="submit" value="Show Product" name="show">
                </form>
                  <?php
                    include("../connection.php");
                    if(isset($_POST['show']))
                    {
                      $sql="select * from product";
                      $r=mysqli_query($con,$sql);
                      echo "<table class='table table-striped table-dark' id='customers'>";
                      echo "<thead><tr>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Product Type</th>
                      <th>Brand Name</th>
                      <th>Buying Price</th>
                        </tr></thead><tbody>";
                          while($row=mysqli_fetch_array($r))
                          {
                              $id=$row['p_id'];
                          $pname=$row['pname'];
                          $type=$row['ptype'];
                          $brand=$row['brandname'];
                          $price=$row['bprice'];
                          echo "<tr>
                          <td>$id</td><td>$pname</td><td>$type</td><td>$brand</td><td>$price</td>
                          </tr>";
                          }
                        echo "</tbody></table>";
                    }
                    ?>
                  <hr>
                  <form action="store.php" method="post">
                  <h3 align='center'>Store New Product Information</h3>
                    <div class="form-group">
                      <label for="name">Product ID</label>
                      <select class="form-control" name="pid">
                      <option value="">-Select A Product-</option>
                        <?php
                        include("../connection.php");
                        $sql="select p_id from product";
                        $r=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_array($r))
                            {
                                $id=$row['p_id'];
                                echo "<option value='$id'>$id</option>";
                            }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input class="form-control" type="text" id="quantity" name="quantity" placeholder="quantity..">
                    </div>
                    
                    <div class="form-group">
                      
                        <label for="sprice">Selling Price</label>
                        <input class="form-control" type="text" id="sprice" name="sprice" placeholder="Selling Price..">
                    </div>
                    <div class="form-group">
                      <input class= "btn btn-success" type="submit" value="Add" name="submit">
                    </div>
                </form>
                    <?php
                      include("../connection.php");
                      if(isset($_POST['submit']))
                        {
                          $pid=$_POST['pid'];
                          $quantity=$_POST['quantity'];
                          $sprice=$_POST['sprice'];
                          
                          $query="insert into store values('$pid',$sprice,$quantity)";
                          if(mysqli_query($con,$query))
                          {?>
                              <div class="alert alert-success" role="alert">
                                  <strong>Product Stored Successfully</strong>
                              </div>
                          <?php } 
                          else
                          {
                            echo "error!".mysqli_error($con);
                          }
                        }
                    ?>
                <br>
              </div>
            </div>
          </div>
        </div>
  </body>
</html>