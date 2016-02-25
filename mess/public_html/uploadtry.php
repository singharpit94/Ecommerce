<?php
    require_once("../resources/config.php");
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

	///////////////////////////////////////////////////////////////////////
	$year = date("Y");
	$mon = date("M");
	$monthName = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	if ( $year % 400 == 0)
		$leap = "yes";
	else if ($year%100 == 0)
		$leap = "no";
	else if ($year%4 == 0 )
		$leap = "yes";
	else
		$leap = "no";
	if( $leap == "yes")
		$monthSize = array(31,29,31,30,31,30,31,31,30,31,30,31);
	else
		$monthSize = array(31,28,31,30,31,30,31,31,30,31,30,31);
	///////////////////////////////////////////////////////////////////////

	if($_SESSION["email"])
	{
		$login="true";
		$fname=$_SESSION["fname"];
		$lname=$_SESSION["lname"];
		$phone=$_SESSION["phone"];
		$room= $_SESSION["room"];
		$roll=$_SESSION['roll'];
		$email=$_SESSION["email"];
		$type=$_SESSION["type"];

		if($type=="admin"){
			$postEmail = $_POST["email"];
			$postPass = md5($_POST["password"]);
			$postCheck = $_POST["checkbox"];
			//check if info entered is that of admin
			$sql="select type from users_registered where email='$postEmail' and password='$postPass' AND activated='1'";
			$result = query($sql);
            confirm($result);
			if(mysqli_num_rows($result)>0){
				$row = $result->fetch_assoc();
				$type1=$row["type"];
				if($type1!="admin"){
					echo $type1;
					redirect_to("menu.php");
					exit();
				}
			}
            else
            {
                redirect_to("menu.php");
                exit();
            }
			if($postCheck == "on"){
				$target_dir = "uploads/menu/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$filename=basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
				}
				// Check if file already exists
				if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 2000000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "pdf") {
				echo "Sorry, only PDF files are allowed.";
				$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";


					$sql = "insert into menu(name,link) values('$filename','$target_file')";
					$result = query($sql);
                    confirm($result);
					redirect_to("menu.php");
					exit();
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
				}
			}
			else{
				echo "You need to upload a file";
				redirect_to("menu.php");
				exit();
			}
			//redirect_to("index.php");
		}
	}
?> 