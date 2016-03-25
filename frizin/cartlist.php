<?php
 $con = mysqli_connect("127.0.0.1","root","arpit1234");
$user= $_POST['user'];

 //$user= "arpitsinghnitd@gmail.com";
// $product=1;
// $qty=20;
 if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}

	mysqli_select_db($con,"frizin");
	$sql1="SELECT * FROM cart where user_email='$user' ";
	$result1=mysqli_query($con,$sql1);
	$res= array();
	while($row=mysqli_fetch_array($result1)){
		$p=$row['pid'];
		$sql = "Select * from products where pid = '$p' ";
	$result=mysqli_query($con,$sql);
	     $row1=mysqli_fetch_array($result);



		array_push($res,array(
		"pname"=>$row1['pname'],
		
        "pid"=>$row["pid"],
		"pimage"=>$row1['pimage'],
		"price"=>$row1['price'],	
		 "quantity"=>$row['quantity']));	
	}
	echo json_encode($res);
	?>
