<?php
require_once("../resources/config.php");
    $username = $_POST['username'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
        $uuid= $_POST['uuid'];

	//$con = mysqli_connect("localhost","root","arpit1234");

	//if (!$con)
	//{
	//	die('Could not connect: ' . mysqli_error());
	//}

	//mysqli_select_db($con,"mess");
	$sql = "SELECT * FROM gcmusers WHERE email='$email'";
	$check = mysqli_fetch_array(mysqli_query($sql));

	if(isset($check)){
		echo 'username or email already exist';
	}
	else{
		$sql = "INSERT INTO register_table(uuid, name, username, email, password) VALUES('$uuid', '$name', '$username', '$email', '$password')";
		if(mysqli_query($sql)){
			echo 'Successfully Registered';
		}
		else{
		echo 'oops! Please try again!';
		}
	}
	mysqli_close($con);
	

?>
