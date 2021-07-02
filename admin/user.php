<?php include '../connection.php'; ?>
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
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Customers</title>
</head>

<body>
<style>
body  {
  background-color: #404040;
}
</style>
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
          <li class="nav-item">
            <a class="nav-link" href="user.php">Customer List</a>
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
        <div>
            <h2>List all customers</h2>

        </div>

        <div class="row">
            <div class="col-md-12">

                <table id="T" class="table table-danger table-striped">
                    <thead>
                        <th>Name</th>
                        <th>Address</th>
                        
                        <th>Mobile</th>
                       
                        <th>Email</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        $str = "SELECT * from customer";
                        $results = mysqli_query($con, $str);
                        while ($row = mysqli_fetch_array($results)) {  ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                
                                <td><?php echo $row['mobile'] ?></td>
                                
                                <td><?php echo $row['email'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="edit-student.php?id=<?php echo $row['id'] ?>">Edit</a>
                                    <a class="btn btn-danger" data-toggle="modal" data-target="#mm<?php echo $row['id'] ?>">Delete</a>
                                   
                                    </div>
                                </td>
                            </tr>
                        <?php }
                        ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</body>
<script>
    $(document).ready(function() {
        $('#T').DataTable();
    });
</script>


</html>