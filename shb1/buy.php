 <!DOCTYPE html>
<!doctype html>
<?php require_once("include/connection.php"); ?>
<?php include("include/function.php");?>
<html>
<meta charset="UTF-8">
<head>
<link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/radio.css">
<link rel="stylesheet" type="text/css" href="css/b.css">

<style>
p.small {
    line-height: 20%;
}
</style>
<style>
body {
	background: url(Images/nk.jpg) no-repeat center center fixed #000; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
     background-size: 100% 100%;
     overflow: hidden;
}
.over{
position:absolute;
bottom: 10px;
right:10px;
background-color:rgba(185, 68, 49, 0.9);
}
.topq{
	height:80px;
	width:1000px;
  position:relative;
  left:120px;
  background:rgba(255,255,255,0.5);
}

.mid{
  height: 530px;
  width:1000px;
  position:relative;
  left:120px;
  border: 1px solid black;
  background:rgba(0,0,0,0.2);
  padding-left:80px;
}
</style>
</head>
<body>
<?php
     echo'<div class="panel radius topq">';
     if(isset($_POST["pid1"]))
     {
	 $val=$_POST["pid1"];
	 }
	 else $val=$_SESSION['pn'];
    $sql = "SELECT id, Name, type,price,points FROM players";
    $result = mysql_query($sql,$connection);	
    while($row = mysql_fetch_array($result)) 
    {
		echo'<p class="small">';
     if($val==utf8_encode($row["Name"]))
        echo "<h1><div align='center'style='position:relative;bottom:10px;'><font 150% color='black'>".utf8_encode($row["Name"])."</font></div></h1>";
		echo "</p>";
    }
    echo"</div>";
?> 
<div class="panel mid">
 <form action="main.php" method="post">
  <div class="pad">
   <h3 style="color:white;padding-left:80px">TEAMS</h3>
   <?php
    $sk=$_SESSION['teams'];
    foreach ($sk as $key=>$val)
    {
     echo"<div class='divi'><input type='radio' name='tid' id='$key' class='radio' value='$key'/><label for='$key' class='lab'>$val</label></div></br>";
     }
   ?>
   </div>

 <DIV class="container">
  <section class="webdesigntuts-workshop">
  <form action="main.php" method="POST">
		<input type="text" name="pri" placeholder="Final Price...">		    	
		<button>Buy Now</button>
     <?php if(isset($_POST["pid1"])){
	   $val=mysql_real_escape_string($_POST["pid1"]);
	   }
	   else $val=mysql_real_escape_string($_SESSION['pn']);
      $sql = 'SELECT id, Name, type,price,points FROM players WHERE Name= "'.$val.'"';
      $result = mysql_query($sql,$connection);
      $row = mysql_fetch_array($result);
	  $_SESSION["pn"]=$val;
      ?>
</form>
</section>
</DIV>
</div>
<div class="over button alert small"><a href=bid.php style="color:white pt-page-moveToLeft">BACK</a></div>
</body>
</html>