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
	$name1=$_POST["student1"];
	$name2=$_POST["student2"];
	$name3=$_POST["student3"];
	//echo $groupname;
	//echo $name1;
	//echo $name2;
	//echo $name3;

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
$check1=0;
$sql="SELECT * FROM studentlist";
$result= $conn->query($sql);
echo '<div class="transbox">"';
echo "<h1>GROUP ALLOCATION STATUS</h1>";
while($row=$result->fetch_assoc())
{
	if($row['name']==$name1 or $row['name']==$name2 or $row['name']==$name3)
		$check1=1;
}
if($check1==1)
{
	
	echo "<h3>Student already exists!!</h3>";
	
} 

$sql="SELECT * FROM grouplist";
$result=$conn->query($sql);
$check2=0;
while($row=$result->fetch_assoc())
{
	if($row['name']==$groupname)
		$check2=1;
}
if($check2==1)
{
	echo  "<h3>Group name already taken!!</h3>";
	
	
}
if($check1==1 or $check2==1)
{
	echo "<h3></br>"."<a href=groupmaking.html>Click Here to GO BACK</a></h3>";
	echo '"</div>"'; 
}
		
if($check1==0 and $check2==0){
	
$sql="INSERT INTO grouplist(name) VALUES('$groupname')";
if($conn->query($sql)===TRUE)
	echo "<br />";
 
$sql="SELECT * FROM grouplist WHERE name ='$groupname' ";
$result = $conn->query($sql);
$row=$result->fetch_assoc();

$gid=$row["id"];
echo "<h4><br />GROUP ID: $gid</h4>";
echo "<br /><h3>GROUP NAME</h3>";
echo "<h4>$groupname</h4>";
//echo $gid;
echo "<br /><h3>GROUP MEMBERS</h3>";
$sql="INSERT INTO studentlist(name,group_id) VALUES('$name1','$gid')";
if($conn->query($sql) === TRUE)
	echo "<h4>$name1</h4>";

$sql="INSERT INTO studentlist(name,group_id) VALUES('$name2','$gid')";
if($conn->query($sql) === TRUE)
	echo "<h4>$name2</h4>";

$sql="INSERT INTO studentlist(name,group_id) VALUES('$name3','$gid')";
if($conn->query($sql) === TRUE)
	echo "<h4>$name3</h4>";


echo "<h2>Group successfully formed!!";
echo "<h3></br>"."<a href=quiz.html>CLICK HERE TO TAKE THE QUIZ</a></h3>";
echo '"</div>"'; 
}
$conn->close();
?>

</body>
</html>


