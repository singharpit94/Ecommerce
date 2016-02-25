<?php
require_once("../resources/config.php");
function redirect_to($url)
{
    header('Location: ' . $url);
}

?>

<html>
<head>
    <title>Per Day Meals</title>
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
		$half=$row['half'];
        echo "This is the list of number of meals per day for the month of <strong>$monthName[$month] </strong>is";
        echo '<table border="1">
						<tr>
							<th>Day</th>
							<th> Tokens(Lunch)</th>
							<th>Veg(Lunch)</th>
							<th>Non Veg(Lunch) </th>
							<th> Tokens(Dinner)</th>
							<th>Veg(Dinner)</th>
							<th>Non Veg(Dinner) </th>
						</tr>';

           if($half==1)
		   {
        for ($i = 1; $i <= 15; $i++) {
            $str = "day" . $i;
            $sql1 = "select count($str) as total_lunch from fillup where $str = 21 or $str = 22 or $str = 23  or $str = 31  or $str = 32  or $str = 33";
            $sql2 = "select count($str) as veg_lunch from fillup where $str = 21  or $str = 22  or $str = 23";
            $sql3 = "select count($str) as nonveg_lunch from fillup where $str = 31  or $str = 32  or $str = 33";
			$sql4 = "select count($str) as total_dinner from fillup where $str = 12 or $str = 13 or $str = 22  or $str = 23  or $str = 32  or $str = 33";
            $sql5 = "select count($str) as veg_dinner from fillup where $str = 12  or $str = 22  or $str = 32";
            $sql6 = "select count($str) as nonveg_dinner from fillup where $str = 13  or $str = 23  or $str = 33";
            $result1 = query($sql1);
            confirm($result1);
            $result2 = query($sql2);
            confirm($result2);
            $result3 = query($sql3);
            confirm($result3);
			$result4 = query($sql4);
            confirm($result4);
            $result5 = query($sql5);
            confirm($result5);
            $result6 = query($sql6);
            confirm($result6);
            if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0 && mysqli_num_rows($result4) > 0 && mysqli_num_rows($result5) > 0 && mysqli_num_rows($result6) > 0) {
                $row1 = $result1->fetch_assoc();
                $row2 = $result2->fetch_assoc();
                $row3 = $result3->fetch_assoc();
				$row4 = $result4->fetch_assoc();
                $row5 = $result5->fetch_assoc();
                $row6 = $result6->fetch_assoc();


                echo "
										<tr>
											<td>$i</td>
											<td>" . $row1["total_lunch"] . "</td>
											<td>" . $row2["veg_lunch"] . "</td>
											<td>" . $row3["nonveg_lunch"] . "</td>
											<td>" . $row4["total_dinner"] . "</td>
											<td>" . $row5["veg_dinner"] . "</td>
											<td>" . $row6["nonveg_dinner"] . "</td>
										</tr>
									";
            }
        }
		   }
		   else
		   {
			    for ($i = 16; $i <= $monthSize[$month-1]; $i++) {
            $str = "day" . $i;
            $sql1 = "select count($str) as total_lunch from fillup where $str = 21 or $str = 22 or $str = 23  or $str = 31  or $str = 32  or $str = 33";
            $sql2 = "select count($str) as veg_lunch from fillup where $str = 21  or $str = 22  or $str = 23";
            $sql3 = "select count($str) as nonveg_lunch from fillup where $str = 31  or $str = 32  or $str = 33";
			$sql4 = "select count($str) as total_dinner from fillup where $str = 12 or $str = 13 or $str = 22  or $str = 23  or $str = 32  or $str = 33";
            $sql5 = "select count($str) as veg_dinner from fillup where $str = 12  or $str = 22  or $str = 32";
            $sql6 = "select count($str) as nonveg_dinner from fillup where $str = 13  or $str = 23  or $str = 33";
            $result1 = query($sql1);
            confirm($result1);
            $result2 = query($sql2);
            confirm($result2);
            $result3 = query($sql3);
            confirm($result3);
			$result4 = query($sql4);
            confirm($result4);
            $result5 = query($sql5);
            confirm($result5);
            $result6 = query($sql6);
            confirm($result6);
            if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0 && mysqli_num_rows($result4) > 0 && mysqli_num_rows($result5) > 0 && mysqli_num_rows($result6) > 0) {
                $row1 = $result1->fetch_assoc();
                $row2 = $result2->fetch_assoc();
                $row3 = $result3->fetch_assoc();
				$row4 = $result4->fetch_assoc();
                $row5 = $result5->fetch_assoc();
                $row6 = $result6->fetch_assoc();


                echo "
										<tr>
											<td>$i</td>
											<td>" . $row1["total_lunch"] . "</td>
											<td>" . $row2["veg_lunch"] . "</td>
											<td>" . $row3["nonveg_lunch"] . "</td>
											<td>" . $row4["total_dinner"] . "</td>
											<td>" . $row5["veg_dinner"] . "</td>
											<td>" . $row6["nonveg_dinner"] . "</td>
										</tr>
									";
            }
        }
		   }

        ?>
    </table>
</center>
</body>
<html>