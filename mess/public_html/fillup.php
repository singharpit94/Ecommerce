<?php
require_once("../resources/config.php");
function redirect_to($url)
{
    header('Location: ' . $url);
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

		$sql="select id from month";
		$query = query($sql);
        confirm($query);
        $row = fetch_array($query);
        $month = $row['id'];
		
		
		$sql = "UPDATE fillup set ";
		for($i=1;$i<=$monthSize[ $month - 1 ];$i++){
			$strl="lday".$i;
			$str1="dday".$i;
			$str="day".$i;
			$value=$_POST[$strl]*10+$_POST[$str1];
			$sql = $sql.$str."=".$value.",";
		}

		$sql=$sql."month=$month where email='$email';";
			echo $sql;
		$query = query($sql);
        confirm($query);


	}


redirect_to("mydetails.php");
?> 