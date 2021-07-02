<?php
	require_once '../connection.php';
	
	if(ISSET($_POST['save'])){
		$product_name = $_POST['pname'];
		$product_price = $_POST['bprice'];
		$image_name = $_FILES['image']['name'];
		$image_temp = $_FILES['image']['tmp_name'];
		$image_size = $_FILES['image']['size'];
		
		
		if($image_size > 500000){
			echo "<script>alert('File too large to upload')</script>";
			echo "<script>window.location = 'index.php'</script>";
		}else{
			$file = explode(".", $image_name);
			$file_ext = end($file);
			$ext = array("png", "jpg", "jpeg");
 
			if(in_array($file_ext, $ext)){
				$location = "upload/".$image_name;
				if(move_uploaded_file($image_temp, $location))
				{
					mysqli_query($con, "INSERT INTO `product` VALUES('', '$p_name', '$bprice', '$location')") ;
					echo "<script>alert('Product Saved!')</script>";
					echo "<script>window.location = 'index.php'</script>";
				}
			}else{
				echo "<script>alert('Only images allowed')</script>";
				echo "<script>window.location = 'index.php'</script>";
			}
		}
		
		
	}
?>