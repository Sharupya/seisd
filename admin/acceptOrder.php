<?php
    session_start();
    include("../connection.php");
    $oid = $_REQUEST['id'];
    $sqlorderupdate="update customer_order set status=1 where order_id='$oid'";
    mysqli_query($con,$sqlorderupdate);
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
?>