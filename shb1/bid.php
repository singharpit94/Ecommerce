<!doctype html>
<?php require_once("include/connection.php"); ?>
<?php include("include/function.php");?>
<html lang="en">
<meta charset="utf-8">
<head>
	
	<title>BIDING</title>
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	<link rel="stylesheet" href="css/button.css">
	 <script src="js/prefixfree.min.js"></script>
	 <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">
  <script src="js/vendor/modernizr.js"></script>
	 <link rel="stylesheet" type="text/css" href="css/x.css">
	<style>

		
	.custom-combobox {
		position: relative;
		display: inline-block;
	}
	.custom-combobox-toggle {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 5px 10px;
	}
	.nope{
		padding-right:100px;
		padding-top:120px;
		padding-bottom:120px;
		padding-left:80px;
	}
	.trans{
		background:rgba(206, 150, 255, 0.2);
		text-align: center;
        position:relative;
		right:40px;
		height:460px;
	}
	.done{
		padding-left:220px;
		padding-top:30px;
	}
	</style>
	<script src="js/combo.js"></script>
		<style>
body {     
	background: url(Images/surya7.jpg) no-repeat center center fixed #000; 
      -webkit-background-size: cover;
     -moz-background-size: cover;
      -o-background-size: cover;
      background-size: 100% 100%;
      overflow: hidden;
      font: 85% "Trebuchet MS", sans-serif;
		margin: 50px;
}
</style>
</head>
<body >
  <div class="panel clearfix radius" style="background:rgba(255,255,255,0.5); height:650px;">
  <div class="left done" >
 <div class="ringMenu">
 <ul>
  <li class="main"><a href="#main"><b>PLAYER<b></a></li>
  <li class="top"><a href="bid.php?value=1"><h8 style="font-size:90%">GOALKEEPER</h8></a></li>
  <li class="right"><a href="bid.php?value=2"><b>FORWARD</b></a></li>
  <li class="bottom"><a href="bid.php?value=3">DEFENDER</a></li>
  <li class="left"><a href="bid.php?value=4">MIDFIELDER</a></li>
 </ul>
 </div>
 </div>

	
	<?php 
	if(isset($_GET['value']))
	   { 
	   	echo'<div class="panel right trans" style="border: 1px solid rgba(58, 47, 93, 0.4);">';
	   	$GLOBALS['value']= $_GET['value'];
		 show();
        echo'<div class="nope">';
	   	
		echo'</label>';
	    echo'<div align="center" >';
	    echo'<div class="ui-widget">';
	    echo'<form action="buy.php" method="POST">';
	    echo'<select id="combobox" class="dropdown " name="pid1" style="display: none;">';
		$sql = "SELECT id, Name  FROM players WHERE type = '$value' AND status='0'";
        $results = mysql_query($sql,$connection);
         if(!$results){
		       die("database query failed".mysql_error());
		        }
           // output data of each row
	     $v=0;
	     $v1='Player Name';
	    echo "<option value =''>$v1</option>";
        while($row=mysql_fetch_array($results)) {
        //echo "<tr><td>".$row["id"]."</td><td>".$row["Name"]."</td></tr>";
		$var=$row["Name"];
		$var1=$row["id"];
		//echo $var1;
		//echo $var;
		//echo "<option>$var1</option>";
		echo '<option value="'.utf8_encode($var).'">'.utf8_encode($var).'</option>';
          }

	  
	echo"</select>";
	echo'<p style="padding-top:50px;padding-left:40px;">';
	echo'<button class="small" style="background:rgba(4, 20, 0, 0.6);font-size:15px;">';
    echo'SELECT';
    echo'</button>';
	echo'</p>
	</form>
	</div>
	</div>
	</div>
   </div>';
     }
     ?>
</div>
 <script>
    $(document).foundation();
  </script>
</body>
<?php require("include/close.php");?>
</html>