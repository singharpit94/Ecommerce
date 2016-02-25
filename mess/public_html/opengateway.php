<?php
    require_once("../resources/config.php");
	date_default_timezone_set("Asia/Kolkata");
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
	
	function logs2($size,$month){
		$fileName = date("D M j G-i-s T Y");
		$fileName = "logs/".$fileName.".txt";
		$myfile = fopen($fileName, "w") or die("Unable to open file!");
		fwrite($myfile, $fileName);

		fwrite($myfile, "\n$month\n");
		
		$sql = "select * from fillup;";
		$result = query($sql);
        confirm($result);
		if(mysqli_num_rows($result)>0){
			while( $row = $result->fetch_assoc() ){
				$str = $row["email"];
				for($i = 1; $i <= $size ; $i++){
					$day = "day".$i;
					$str = $str." ".$row[$day];
				}
				$str = $str."\n";
				fwrite($myfile, $str);
			}
		
		}
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
	
	
	
	
	
	
	$postCheck = $_POST["checkbox"];
	if($postCheck != "on"){
		redirect_to("index.php");
		exit();
	}
	
	
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

			//check if info entered is that of admin
			$sql="select type from users_registered where email='$postEmail' and password='$postPass'";
			$result = query($sql);
            confirm($result);
			if(mysqli_num_rows($result)>0){
				$row = fetch_array($result);
				$type1=$row["type"];
				if($type1!="admin"){
					redirect_to("index.php");
					exit();
				}
				else if($type1=="admin"){
					$sqle="select * from enable ";
            $resulte = query($sqle);
            confirm($resulte);
			$rowe=fetch_array($resulte);
			
			echo $rowe['status'];
			if($rowe['status']==0){
			$sql="select id from month";
			$result = query($sql);
            confirm($result);
			$row = fetch_array($result);
			$month=$row["id"];
			$month=($month + 1)%12;
			
			//create a log
			logs2($monthSize[$month - 1],$month);
			
			//perform init



			$sql = "select email,food from users_registered WHERE activated='1';";
			$result=query($sql);
			while($row = $result -> fetch_assoc()){
                $em = $row['email'];
                $food_fill = $row['food']*10 +$row['food'];
                $sql1="update fillup set day1=$food_fill,day2=$food_fill,day3=$food_fill,day4=$food_fill,day5=$food_fill,day6=$food_fill,day7=$food_fill,day8=$food_fill,day9=$food_fill,day10=$food_fill,day11=$food_fill,day12=$food_fill,day13=$food_fill,day14=$food_fill,day15=$food_fill,day16=$food_fill,day17=$food_fill,day18=$food_fill,day19=$food_fill,day20=$food_fill,day21=$food_fill,day22=$food_fill,day23=$food_fill,day24=$food_fill,day25=$food_fill,day26=$food_fill,day27=$food_fill,day28=$food_fill,day29=$food_fill,day30=$food_fill,day31=$food_fill,month='$month' WHERE email='$em';";
                $result1 = query($sql1);
                if(confirm2($result1) === TRUE)
                {
                    logs("Init Performed!! ");
                }
            }
				
			$sql="update month set id='$month';";
            $result = query($sql);
			if (confirm2($result) === TRUE){
				logs("Month Updated to $month");
			}


			//enable
			$sql="update enable set status=1;";
            $result = query($sql);
            confirm($result);
			redirect_to("admin.php");
			}
			else{
				redirect_to("admin.php");
			}
		
				}
			}
            else
            {
                redirect_to("admin.php");
                exit();
            }
			
			/*$sql="select id from month";
			$result = query($sql);
            confirm($result);
			$row = fetch_array($result);
			$month=$row["id"];
			$month=($month + 1)%12;
			
			//create a log
			logs2($monthSize[$month - 1],$month);
			
			//perform init



			$sql = "select email,food from users_registered WHERE activated='1';";
			$result=query($sql);
			while($row = $result -> fetch_assoc()){
                $em = $row['email'];
                $food_fill = $row['food'];
                $sql1="update fillup set day1=$food_fill,day2=$food_fill,day3=$food_fill,day4=$food_fill,day5=$food_fill,day6=$food_fill,day7=$food_fill,day8=$food_fill,day9=$food_fill,day10=$food_fill,day11=$food_fill,day12=$food_fill,day13=$food_fill,day14=$food_fill,day15=$food_fill,day16=$food_fill,day17=$food_fill,day18=$food_fill,day19=$food_fill,day20=$food_fill,day21=$food_fill,day22=$food_fill,day23=$food_fill,day24=$food_fill,day25=$food_fill,day26=$food_fill,day27=$food_fill,day28=$food_fill,day29=$food_fill,day30=$food_fill,day31=$food_fill,month='$month' WHERE email='$em';";
                $result1 = query($sql1);
                if(confirm2($result1) === TRUE)
                {
                    logs("Init Performed!! ");
                }
            }
				
			$sql="update month set id='$month'-1;";
            $result = query($sql);
			if (confirm2($result) === TRUE){
				logs("Month Updated to $month");
			}


			//enable
			$sql="update enable set status=1;";
            $result = query($sql);
            confirm($result);
			redirect_to("admin.php");*/
		}
	}
	echo "init unsuccessful!!";
?>