<html>
	<head>
	<title>
		Status page
	</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<style>
	
		body
		{
			background-image: url(i7.jpg);
			background-size: cover;
		}
		div.transbox 
		{
    		margin: 30px;
    		background-color: #ffffff;
    		border: 1px solid black;
    		opacity: 0.6;
    		filter: alpha(opacity=60); /* For IE8 and earlier */
		}

		div.transbox p 
		{
    		margin: 5%;
    		font-weight: bold;
    		color: #000000;
    	}
		p
		{
			text-align: center;
		}
		h1
		{
			text-align:center;
			font-weight: bold;
		}
		h2
		{
			text-align:center;
		}
		h3
		{
			text-align: center;
		}
		h4
		{
			text-align: center;
		}
		h5
		{
			text-align: center;
		}
		h6
		{
			text-align: center;
		}
	</style>
	<body>
<?php

	$groupname=$_POST["groupname"];
	//echo $groupname;

$servername = "localhost";
$username = "root";
$password = "arpit1234";
$dbname = "Studentproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
echo '<div class="transbox">"';
echo "<h1>STATUS OF GROUP</h1>";
$sql="SELECT * FROM grouplist WHERE name='$groupname' ";
$result=$conn->query($sql);


$row=$result->fetch_assoc();
//$marks=$row["marks"];
$id=$row["id"];

//$gid=$row["id"];
$status=$row["status"];
$marks=$row["marks"];

//echo $gid;
$sql="SELECT * FROM studentlist WHERE group_id='$id' ";
$result=$conn->query($sql);
echo "<h3>GROUP ID: $id</h3>";
echo "<h3>GROUP MEMBERS</h3><br />";
while($row=$result->fetch_assoc())
{
	$name=$row["name"];
	echo "<h4>$name</h4>";
	echo "</br>";
}
echo "<h3>Marks obtained: $marks </h3>";
//echo $marks;
echo "</br>";
if($status==1)
	echo "<h3><b>SELECTED</b></h3>";
else
	echo "<h3><b>NOT SELECTED</b></h3>";
echo "<h3>"."<a href=openpage.html>Click Here to Register for a new group</a></h3>";
//$conn->close();

echo '"</div>"'; 
?>
