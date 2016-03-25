<?php
 $con = mysqli_connect("127.0.0.1","root","arpit1234");
 $type = $_POST['type'];
 if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}

	mysqli_select_db($con,"frizin");
	$sql = "Select * from products where type = '$type' ";
	$result=mysqli_query($con,$sql);
	$res= array();
	while($row=mysqli_fetch_array($result)){
		array_push($res,array(
		"pname"=>$row['pname'],
		"pdesc"=>$row['pdesc'],
                              "pid"=>$row["pid"],
		"pimage"=>$row['pimage'],
		"price"=>$row['price']));	
	}
echo json_encode($res);
?>
