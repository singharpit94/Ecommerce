<?php
require_once("../resources/config.php");
date_default_timezone_set("Asia/Kolkata");
function redirect_to($url)
{
    header('Location: ' . $url);
}

function logs($str)
{
    $myfile = fopen("log.txt", "a") or die("Unable to open file!");
    $txt = date("[D M j G:i:s T Y]\n");
    fwrite($myfile, $txt);
    fwrite($myfile, "$str\n\n");
    fclose($myfile);
}

function logs2($size, $month)
{
    $fileName = date("D M j G-i-s T Y");
    $fileName = "logs/" . $fileName . ".txt";
    $myfile = fopen($fileName, "w") or die("Unable to open file!");
    fwrite($myfile, $fileName);
    fwrite($myfile, "\n$month\n");

    $sql = "select * from fillup;";
    $result = query($sql);
    confirm($result);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $str = $row["email"];
            for ($i = 1; $i <= $size; $i++) {
                $day = "day" . $i;
                $str = $str . " " . $row[$day];
            }
            $str = $str . "\n";
            fwrite($myfile, $str);
        }

    }
    fclose($myfile);
}


///////////////////////////////////////////////////////////////////////
$year = date("Y");
$mon = date("M");
$monthName = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
if ($year % 400 == 0)
    $leap = "yes";
else if ($year % 100 == 0)
    $leap = "no";
else if ($year % 4 == 0)
    $leap = "yes";
else
    $leap = "no";
if ($leap == "yes")
    $monthSize = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
else
    $monthSize = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
///////////////////////////////////////////////////////////////////////


$postCheck = $_POST["checkbox"];
if ($postCheck != "on") {
    redirect_to("index.php");
    exit();
}


if ($_SESSION["email"]) {
    $login = "true";
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $phone = $_SESSION["phone"];
    $room = $_SESSION["room"];
    $roll = $_SESSION['roll'];
    $email = $_SESSION["email"];
    $type = $_SESSION["type"];

    if ($type == "admin") {
        $postEmail = $_POST["email"];
        $postPass = md5($_POST["password"]);
		

        //check if info entered is that of admin
        $sql = "select type from users_registered where email='$postEmail' and password='$postPass'";
        $result = query($sql);
        confirm($result);
        if (mysqli_num_rows($result) > 0) {
            $row = fetch_array($result);
            $type1 = $row["type"];
            if ($type1 != "admin") {
                redirect_to("index.php");
                exit();
            }
			else if($type1=="admin"){
				 $sql = "update enable set status=0;";
        $result = query($sql);
        confirm($result);
		$sql = "insert into backup select * from fillup;";
            $result = query($sql);
            confirm($result);
        redirect_to("admin.php");
		
			}
		}
        else
        {
            redirect_to("admin.php");
            exit();
        }

        $sql = "select id from month";
        $result = query($sql);
        confirm($result);
        $row = fetch_array($result);
        $month = $row["id"];

        //create a log
        logs2($monthSize[$month - 1], $month);

        
    }
}
echo "init unsuccessful!!";
?>