<?php
 $con = mysqli_connect("127.0.0.1","root","arpit1234");
$user= $_POST['user'];
 $product=$_POST['product_id'];
 $qty=$_POST['qty'];
 //$user= "arpitsinghnitd@gmail.com";
// $product=1;
// $qty=20;
 if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}

	mysqli_select_db($con,"frizin");
	$sql1="SELECT * FROM cart where user_email='$user' AND pid='$product'";
	$result1=mysqli_query($con,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	if($row1>0)
	{    
         $newqty=$row1['quantity']+$qty;
		
		$sql2="UPDATE cart SET quantity='$newqty' where user_email='$user' AND pid='$product'";
		$result2=mysqli_query($con,$sql2);
		if (mysqli_affected_rows($con) == 1) {
			echo "UPDATED";
		}
	}
	else 
	{   
		$sql3="INSERT INTO cart (quantity,user_email,pid)
                                      VALUES ('$qty','$user','$product')";
		$result3=mysqli_query($con,$sql3);
		if (mysqli_affected_rows($con) == 1) {
			echo "INSERTED";
		}
	}
	?>