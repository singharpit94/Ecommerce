<?php
require_once("../resources/config.php");
?>

<html>
<head>
    <title>Student</title>
    <style>
        table
        {
            width: 80%;
            border-collapse: collapse;
        }
        th,td{
            padding: 10px;
            text-align: left;
        }
    </style>

</head>
<body>
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

    $sql = "select id from month";
    $result = query($sql);
    confirm($result);
    $row = fetch_array($result);
    $month = $row['id'];

    echo "<tr><th>Name</th><th>Roll</th>";
    for ($i = 1; $i <= $monthSize[$month - 1]; $i++)
        echo "<th>$i</th>";
    echo "</tr>";

    $sql = "select first_name,last_name,email,roll_no from users_registered WHERE activated='1' order by roll_no asc;";
    //$sql="select fname,lname,day1,day2,day3,day4,day5,day6,day7,day8,day9,day10,day11,day12,day13,day14,day15,day16,day17,day18,day19,day20,day21,day22,day23,day24,day25,day26,day27,day28,day29,day30,day31 from user;";
    $result = query($sql);
    confirm($result);

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>";
            echo $row['first_name'] . " ";
            echo $row['last_name'];
            echo "</td>";
            echo "<td>";
            echo $row['roll_no'];
            echo "</td>";

            $sql2 = "select email,day1,day2,day3,day4,day5,day6,day7,day8,day9,day10,day11,day12,day13,day14,day15,day16,day17,day18,day19,day20,day21,day22,day23,day24,day25,day26,day27,day28,day29,day30,day31 from fillup where email='" . $row['email'] . "';";
            $result2 = query($sql2);
            confirm($result2);
            if (mysqli_num_rows($result2) > 0) {
                $row2 = $result2->fetch_assoc();

                for ($i = 1; $i <= $monthSize[$month - 1]; $i++) {
                    $day = "day" . $i;
                    echo "<td>$row2[$day]</td>";
                }
                echo "</tr>";
            }
        }
    }

    ?>
</table>
</body>
<html>