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
<nav class="navbar navbar-expand-sm bg-danger navbar-dark">
  
  
    
      <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="../index.php">Home</a></li>
        
       
      <ul class="nav navbar-nav navbar-right offset-6">
      <li class= "nav-item"  ><a class="nav-link" href="changepass.php"><span class="glyphicon glyphicon-user"></span>Change Password</a></li>
        <li class= "nav-item"><a class="nav-link" href="?sign=out"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    
  
</nav>
    <div class="container">
        <div>
            <h2>List all SILVER rated customers</h2>

        </div>

        <div class="row">
            <div class="col-md-12">

                <table id="T" class="table table-danger table-striped">
                    <thead>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>BIRTH DATE</th>
                        <th>Email</th>
                        
                    </thead>
                    <tbody>
                        <?php
                        $str = "SELECT * from customer";
                        $results = mysqli_query($con, $str);
                        while ($row = mysqli_fetch_array($results)) {  ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['gender'] ?></td>
                                <td><?php echo $row['mobile'] ?></td>
                                <td><?php echo $row['dob'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                
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