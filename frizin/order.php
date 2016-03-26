<?php
 $con = mysqli_connect("127.0.0.1","root","arpit1234");
$user= $_POST['user'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$address=$_POST['address'];

/*$user= "arpitsinghnitd@gmail.com";
$name="Arpit";
$phone="9832821697";
$address="kfkfff";*/
 if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}
     $amount=0;
     
     $res= array();
	mysqli_select_db($con,"frizin");
	//$sql="INSERT into orders SELECT * from cart where user_email='$user'"
	//$result=mysqli_query($sql);
	$sql1="SELECT * FROM cart where user_email='$user'";
	$result1=mysqli_query($con,$sql1);
	while($row=mysqli_fetch_array($result1)){
		$p=$row['pid'];
		$sql = "Select * from products where pid = '$p' ";
	$result=mysqli_query($con,$sql);
	     $row1=mysqli_fetch_array($result);
	     $temp=$row['quantity']*$row1['price'];
	     $amount=$amount+$temp;
	     $qty=$row['quantity'];
	     array_push($res,array(
		"pname"=>$row1['pname'],
		
        "pid"=>$row["pid"],
		"amount"=>$amount,
		"price"=>$row1['price'],	
		 "quantity"=>$row['quantity']));
	     $sql3="INSERT into orders (user_email,pid,quantity) values('$user','$p','$qty')";
         $result3=mysqli_query($con,$sql3);




			
	}
	$sql4="DELETE from cart";
	$result4=mysqli_query($con,$sql4);

	$sql2="INSERT into billing (user_email,amount,address,name,phone) values('$user','$amount','$address','$name','$phone')";
	$result2=mysqli_query($con,$sql2);
	echo json_encode($res);
	?>