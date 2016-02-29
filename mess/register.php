<?php
require_once("../resources/config.php");
function redirect_to($url)
{
    header('Location: '.$url);
}
?>

<html>
<head>
    <title>Register </title>
</head>
<body>
<center>
    <table border="1">
        <?php

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


        $sql = "select * from month";
        $result = query($sql);
        confirm($result);
        $row = fetch_array($result);
        $month = $row['id'];
		$month--;
		$half=$row['half'];
       
        $sql1="select * from users_registered";
		$result1=query($sql1);
		confirm($result1);
		while ($row = $result1->fetch_assoc())
		{
			$email=$row['email'];
			$food=$row['food']*10 +$row['food'];
			$sql2="select * from fillup where email='$email'";
			$result2=query($sql2);
			confirm($result2);
			$check = mysqli_num_rows($result2);
			if($check==0)
			{
				$sql = "INSERT INTO fillup (email, day1, day2, day3, day4, day5, day6, day7, day8, day9, day10, day11, day12, day13, day14, day15, month) VALUES ('$email', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food','$month');";
                $query = query($sql);
                confirm($query);
			}
		}
		echo "Done";
         ?>
    </table>
</center>
</body>
<html>