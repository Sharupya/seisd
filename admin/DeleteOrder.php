<?php
    session_start();
    include("../connection.php");
    $oid = $_REQUEST['id'];
    $sqlorderupdate="delete from customer_order where order_id='$oid'";
    mysqli_query($con,$sqlorderupdate);
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
?>