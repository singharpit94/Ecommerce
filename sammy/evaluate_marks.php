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
	$ans1=$_POST["answer1"];
	$ans2=$_POST["answer2"];
	$ans3=$_POST["answer3"];
	$ans4=$_POST["answer4"];
	$ans5=$_POST["answer5"];
	$groupname=$_POST["groupname"];
	//echo $ans1;
	//echo $ans2;
	//echo $ans3;
	//echo $ans4;
	//echo $ans5;
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

$sql="SELECT * FROM grouplist WHERE name='$groupname' ";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
//$marks=$row["marks"];
echo '<div class="transbox">';
echo "<h1>STATUS OF GROUP SELECTION<br /></h1>";

$id=$row["id"];
//echo $id;
echo "<h3>GROUP NAME: $groupname<br /></h3>";
//echo "<h4>GROUP ID: $id<br /><h4>";

if($ans1=="TWO")
	$marks=$marks+10;
if($ans2=="STACK")
	$marks=$marks+10;
if($ans3=="DELETION")
	$marks=$marks+10;
if($ans4=="BACKTRACKING")
	$marks=$marks+10;
if($ans5=="NO")
	$marks=$marks+10;
$sql="UPDATE grouplist SET marks='$marks' WHERE name='$groupname' ";
if($conn->query($sql))
	echo "<h2>Marks updated: $marks</h2> ";
//echo $marks;
$status=0;
if($marks>=40)
	$status=1;
$sql="UPDATE grouplist SET status='$status' WHERE name='$groupname' ";
if($conn->query($sql))
	echo "<br />";
if($status==1)
	echo "<h2>Status:<b>SELECTED!</b></h2>";
else
	echo "<h2>Status:<b>NOT SELECTED!</b></h2>";
$sql="UPDATE studentlist SET status='$status' WHERE group_id='$id' ";
if($conn->query($sql))
	echo "<br />";
 
echo "<h3></br>"."<a href=evaluation.html>Click Here to check</a></h3>";
echo '"</div>"'; 
$conn->close();
?>
	
</body>
</html>