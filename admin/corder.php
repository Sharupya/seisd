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
      <div class="card text-white bg-dark mb-8" style="max-width: 70rem;">
        <div class="card-header">Orders</div>
          <div class="card-body">
            <h5 class="card-title">Customer Orders</h5>
              <?php
                  include("../connection.php");
                  $sql="select * from customer_order where status=0";
                  $r=mysqli_query($con,$sql);
                  echo "<table class='table table-striped table-dark' id='customers'>";
                  echo "<thead> <tr>
                  <th>Order ID</th>
                  <th>Customer ID</th>
                  <th>Product Code</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Order Date</th>
                  <th>Action</th>
                  </tr></thead><tbody>";
                  while($row=mysqli_fetch_array($r))
                    {
                        if(!$row['status']){
                        $oid=$row['order_id'];
                        $cid=$row['cus_id'];
                        $odate=$row['order_date'];
                        $p=$row['p_id'];
                        $qty=$row['quantity'];
                        $pr=$row['t_price'];
                        
                        ?>
                          <tr>
                            <td><?php echo $oid ?></td>
                            <td><?php echo $cid ?></td>
                            <td><?php echo $p ?></td>
                            <td><?php echo $qty ?></td>
                            <td><?php echo $pr ?></td>
                            <td><?php echo $odate ?></td>
                            <td>
                            <a class="btn btn-success" href='acceptOrder.php?id=<?php echo $oid ?>'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-capslock-fill" viewBox="0 0 16 16"><path d="M7.27 1.047a1 1 0 0 1 1.46 0l6.345 6.77c.6.638.146 1.683-.73 1.683H11.5v1a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-1H1.654C.78 9.5.326 8.455.924 7.816L7.27 1.047zM4.5 13.5a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-1z"/></svg></a>
                            <a class="btn btn-danger" href='DeleteOrder.php?id=<?php echo $oid ?>'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/></svg></a>
                            </td>
                            </tr>
                      <?php }
                    }  ?>
                  </table>
          </div>
        </div>
      </div>
    </div>
  <?php
  include("../connection.php");
  if(isset($_POST['corder']))
  {
    $sqlorderupdate="update customer_order set status=1 where order_id='$oid'";
      mysqli_query($con,$sqlorderupdate);
    echo "Order Confirmed!";
  }
  ?>
  </body>
</html>

