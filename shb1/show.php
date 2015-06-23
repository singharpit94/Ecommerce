

<!DOCTYPE html>
<?php require_once("include/connection.php"); ?>
<?php include("include/function.php");?>
<html>
 <meta charset="UTF-8"/>

 <title>TEAMS</title>
 <head>

 <h1 class="header">TEAMS</h1>
 <link rel="stylesheet" type="text/css" href="css/mycss.css" />
 <style type="text/css"> 
.button { width: 150px; padding: 10px; background-color:rgba(199, 125, 29, 0.9); box-shadow: -8px 8px 10px 3px rgba(0,0,0,0.2); 
		font-weight:bold; text-decoration:none; } 
#cover{ position:fixed; top:0; left:0; background:rgba(0,0,0,0.6); z-index:5; width:100%; height:100%; display:none; } 
#Screen { height:380px; width:400px; margin:0 auto; position:relative; z-index:10; display:none;
				background-color:#CCFFFF; border:5px solid #cccccc; border-radius:10px; } 
#Screen:target, #Screen:target + #cover{ display:block; opacity:2; } 
.cancel { display:block; position:absolute; top:3px; right:2px; background:rgb(245,245,245); 
color:black; height:30px; width:35px; font-size:30px; text-decoration:none; text-align:center; font-weight:bold; } 
.win{position:relative;top:-280px;left:25px;font: 200% "Trebuchet MS", sans-serif;
}

</style> 
 </head>
 
  <body>
  
 <?php
 
// Create connection
$conn = new mysqli(HOST,US_NAME,PASS_W,DB_NAME);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM list  ";
$result = $conn->query($sql);
$row=$result->fetch_assoc();


 	if($row["penality"]<=2){
 	echo'<div class="team">
	    <div class="teams_a">
 		<h3>'.$_SESSION["teams"][1].'</h3>
 		<p>POINTS='.$row["points"].'</p>
		</div>';
	}
	else
	{
	     echo'<div class="team">
	    <div class="teams_a">
 		<h3>'.$_SESSION["teams"][1].'</h3>
 		<p >DISQUALIFY</p>
		</div>';
	}
		$row=$result->fetch_assoc();
		if($row["penality"]<=2){
 	echo'<div class="teams_b">
 		<h3>'.$_SESSION["teams"][2].'</h3>
 		<p>POINTS='.$row["points"].'</p>
		</div>';}
		else{
		      echo'<div class="teams_b">
 		<h3>'.$_SESSION["teams"][2].'</h3>
 		<p>DISQUALIFY</p>
		</div>';
			  
		}
		$row=$result->fetch_assoc();
		if($row["penality"]<=2){
	     echo' <div class="teams_a">
 		<h3>'.$_SESSION["teams"][3].'</h3>
 		<p>POINTS='.$row["points"].'</p>
		</div>';	}
		else{
		   echo' <div class="teams_a">
 		<h3>'.$_SESSION["teams"][3].'</h3>
 		<p>DISQUALIFY</p>
		</div>';
		}
		$row=$result->fetch_assoc();
		if($row["penality"]<=2){
		echo'<div class="teams_b">
 		<h3>'.$_SESSION["teams"][4].'</h3>
 		<p>POINTS='.$row["points"].'</p>
		</div>';}
		else
		{
		
		echo'<div class="teams_b">
 		<h3>'.$_SESSION["teams"][4].'</h3>
 		<p>DISQUALIFY</p>
		</div>';
		    
		}
		$row=$result->fetch_assoc();
		if($row["penality"]<=2){
		echo' <div class="teams_a">
 		<h3>'.$_SESSION["teams"][5].'</h3>
 		<p>POINTS='.$row["points"].'</p>
		</div>';}
		else
		{
		 echo' <div class="teams_a">
 		<h3>'.$_SESSION["teams"][5].'</h3>
 		<p>DISQUALIFY</p>
		</div>';   
		}
		$row=$result->fetch_assoc();
		if($row["penality"]<=2){
		echo'<div class="teams_b">
 		<h3>'.$_SESSION["teams"][6].'</h3>
 		<p>POINTS='.$row["points"].'</p>
		</div>';}
		else
		{
		    echo'<div class="teams_b">
 		<h3>'.$_SESSION["teams"][6].'</h3>
 		<p>DISQUALIFY</p>
		</div>';
		}
		$row=$result->fetch_assoc();
		if($row["penality"]<=2){
		echo' <div class="teams_a">
 		<h3>'.$_SESSION["teams"][7].'</h3>
 		<p>POINTS='.$row["points"].'</p>
		</div>';}
		else{
		   echo' <div class="teams_a">
 		<h3>'.$_SESSION["teams"][7].'</h3>
 		<p>DISQUALIFY</p>
		</div>';
		}
		$row=$result->fetch_assoc();
		if($row["penality"]<=2){
		echo'<div class="teams_b">
 		<h3>'.$_SESSION["teams"][8].'</h3>
 		<p>POINTS='.$row["points"].'</p>
		</div>';}
		else{
		 echo'<div class="teams_b">
 		<h3>'.$_SESSION["teams"][8].'</h3>
 		<p>DISQUALIFY</p>
		</div>';
		   
		}
		
		
		$sq="SELECT * FROM list ";
		$re = $conn->query($sql);
		$max=0;

		$val=0;

        while($rw = $re->fetch_assoc()) {
		
		if($rw["points"]>$max&&$rw["total"]==15)
		{   $max=$rw["points"];
		     $val=$rw["id"];
		 }
		
		
	  }
	   if($val>0)
	   {
	   	echo '<div style="position :fixed;bottom:50px; left:45%;align:center;"></br><a href="#Screen" class="button">WINNER</a> 
            </div> <div id="Screen"><div class="win">WINNER IS TEAM '.$_SESSION["teams"][$val].'</div>
            <a href="#" class="cancel">&times;</a> </div> <div id="cover" > </div> </div>';
	   }
	  else 
	  {
	  	echo '<div style="position :fixed;bottom:50px; left:45%;align:center;"></br><a href="#Screen" class="button">WINNER</a> 
            </div> <div id="Screen"><div class="win">&nbsp;&nbsp;NO WINNER</div>
            <a href="#" class="cancel">&times;</a> </div> <div id="cover" > </div> </div>';
	  }
	
		
		
		?>
 </body>
 </html>
 