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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <title>Document</title>

    
</head>
<body>
<div class="contrainer">

<div class="col-md-3"></div>
<div class="col-md-6 well">
    <h3 class="text-primary">PHOTOMARKET</h3>
    <hr style="border-top:1px dotted #ccc;"/>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_coupon"><span class="glyphicon glyphicon-plus"></span> Generate Coupon</button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form_product"><span class="glyphicon glyphicon-plus"></span> Add Product</button>
    <br />
    <br />
    <?php
        require '../connection.php';
        
        $query = mysqli_query($con, "SELECT * FROM `product`");
        while($fetch = mysqli_fetch_array($query)){
    ?>
        <div class="col-md-3" style="border:1px solid #ccc; padding:10px; margin:23px; height:250px;">
            <img src="<?php echo $fetch['image']?>" width="100%"/>
            <center><h5><?php echo $fetch['pname']?></h5></center>
            <center><h5>&#8369;<?php echo number_format($fetch['bprice'])?></h5></center>
            <br />
            <center><a href="purchase.php?p_id=<?php echo $fetch['p_id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart"></span> Purchase</a></center>
        </div>
    <?php		
        }
    ?>
</div>
<div class="modal fade" id="form_coupon" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="save_coupon.php" method="POST">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Coupon Code</label>
                            <input type="text" class="form-control" name="coupon" id="coupon" readonly="readonly" required="required"/>
                            <br />
                            <button id="generate" class="btn btn-success" type="button"><span class="glyphicon glyphicon-random"></span> Generate</button>
                        </div>
                        <div class="form-group">
                            <label>Discount</label>
                            <input type="number" class="form-control" name="discount" min="10" required="required"/>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="form_product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="save_product.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="number" class="form-control" name="product_price" min="0" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" class="form-control" name="product_image" required="required"/>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                </div>
            </div>
        </form>
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
</div>
</body>
</html>