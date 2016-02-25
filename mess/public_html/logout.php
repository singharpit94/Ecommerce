<?php
	session_start();
	function redirect_to($url)
	{
	header('Location: '.$url);
	}

	function logs($str){
		$myfile = fopen("log.txt", "a") or die("Unable to open file!");
		$txt = date("[D M j G:i:s T Y]\n");
		fwrite($myfile, $txt);
		fwrite($myfile, "$str\n\n");
		fclose($myfile);
	}
	if(isset($_SESSION["email"]))
	{
		$login="true";
		$fname=$_SESSION["fname"];
		$lname=$_SESSION["lname"];
		$phone=$_SESSION["phone"];
		$room= $_SESSION["room"];
		$roll=$_SESSION['roll'];
		$email=$_SESSION["email"];
		$type=$_SESSION["type"];
		$_SESSION = array();
		session_destroy();
		logs("$type User Log Out.\n$fname $lname $email");
	}
	redirect_to("index.php");
?>


