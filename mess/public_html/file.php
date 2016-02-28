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
       
        echo '<table border="1">
						<tr>
							<th>Student Name</th>
							<th> Lunch Option</th>
							<th>Signature of Student</th>
							
							<th>Dinner Option</th>
							<th>Signature of Student</th>
						</tr>';
						
						
				$sql1="select f.email,f.day3,u.first_name,u.last_name,u.email from fillup f,users_registered u where f.email=u.email order by first_name ASC ";
				$result1=query($sql1);
				confirm($result1);
				$no_of_rows=mysqli_num_rows($result1);
				 while ($row = $result1->fetch_assoc())
				 {
					 $email= $row['email'];
					// $sql2="select * from users_registered where email='$email'";
					// $result2=query($sql2);
				    // confirm($result2);
					// $row2=mysqli_fetch_assoc($result2);
					 $name= $row['first_name']." ".$row['last_name'];
                     $day=$row['day3'];
					 $dinner=$day%10;
					// echo $dinner;
					 $lunch=round($day/10);
					// echo $lunch;
					if($day>11)
					{
						if($lunch==1)
							$lunchoption="None";
						else if($lunch==2)
							$lunchoption="Veg";
						else if($lunch==3)
							$lunchoption="Non Veg";
						//echo $lunchoption;
						
						if($dinner==1)
							$dinneroption="None";
						else if($dinner==2)
							$dinneroption="Veg";
						else if($dinner==3)
							$dinneroption="Non Veg";
						//echo $dinneroption;
						
						echo "
										<tr>
											
											<td>" . $name . "</td>
											<td>" . $lunchoption . "</td>
											<td>" . "                            " . "</td>
											<td>" . $dinneroption . "</td>
											<td>" . "                           ". "</td>
											
										</tr>
									";
						
					}
					
					
					 
					 
				 }
					
				

         ?>
    </table>
</center>
</body>
<html>