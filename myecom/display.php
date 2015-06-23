<?php require_once("include/connection.php"); ?>
<?php include("include/function.php");?>
<html>
<head>
<title>MY ECOMMERCE	</title>



 <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bootstrap-3.3.2-dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap-3.3.2-dist/js/npm.js"></script>
    <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap-theme.css">
    <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/social.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<style>







.items{
      padding-left: 200px;
      padding-top: 20px;
    }

    .foot{
      width: 100%;
    }
   

	

  .overflow{
      overflow-x: hidden;
    }
        .foot{
        	position: relative;
   width:100%;
   padding-top: 50%;
    }
	.panl{
      width: 150px;
      position: absolute;
      padding-top: 20px;
    }
	 .filt{
      width: 150px;
      position: absolute;
      padding-top: 300px;
    }
</style>

</head>
<body>
<?php
echo '<div class="overflow">';
 //<!-- Header -->


echo '<nav class="navbar navbar-inverse">';
  echo '<div class="container-fluid">';
   // <!-- Brand and toggle get grouped for better mobile display -->
    echo '<div class="navbar-header">';
     echo' <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">';
       echo' <span class="sr-only">Toggle navigation</span>';
        echo '<span class="icon-bar"></span>';
        echo '<span class="icon-bar"></span>';
        echo '<span class="icon-bar"></span>';
      echo '</button>';
     echo ' <a class="navbar-brand" href="display.php">Shop Now  <span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>';
   echo ' </div>';

   
    $conn = new mysqli(HOST,US_NAME, PASS_W,DB_NAME);
     $tn=$_SESSION['product'];
	 
	 foreach($tn as $key=>$nt)
	 {
		 $k=$nt;
		 
		 
		echo ' <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
      echo '<ul class="nav navbar-nav">';
       echo " <li><a href=display.php?key=$k>".$k." </a></li>";
       // <li><a href="#">Laptops </a></li>
       // <li><a href="#">Accessories </a></li>
     echo ' </ul>';
		// echo"<ul>";
		  // echo"<li ><a href=display.php?key=$k>".$k."</a></li>";
		  // echo"</ul>";
	 }
	echo' <ul class="nav navbar-nav navbar-right">';
       echo ' <li><a href="#"><span class="glyphicon glyphicon-shopping-cart fa-1x" aria-hidden="true"></span></a></li>';
       echo '<li><a href="#">Sign in</a></li>';
        echo '<li><a href="#">Sign up</a></li>';
     echo ' </ul>';
	 echo '<form class="navbar-form navbar-right" role="search">';
      echo '  <div class="form-group">';
         echo ' <input type="text" class="form-control" placeholder="Search">';
        echo '</div>';
        echo '<button type="submit" class="btn btn-default">Go</button>';
     echo ' </form>';
   echo ' </div><!-- /.navbar-collapse -->';
 echo' </div><!-- /.container-fluid -->';
echo '</nav>';
	 
	 
 if(isset($_GET['key'])){
	 
	 
	 $val=$_GET['key'];
	 $sql3="SELECT DISTINCT company FROM $val";
	 $result3 = mysql_query($sql3);

if (mysql_num_rows($result3) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
echo '<div class="panl">';
echo  '<h4><b><center>Brand</center></b></h4>';
echo '<ul class="list-group">';



while ($row3 = mysql_fetch_assoc($result3)){
	       $k1=$row3["company"];
		   echo"<div class='list-group-item'><a href=display.php?key1=$k1&&key=$val >".$k1."</a></div>";            //brand
	
}
echo "</ul>";
echo'</div>';
	

//$cn=$_SESSION["company"];
	// echo $val;
	 /*foreach($cn as $key1=>$nt)
	 {
		 $k1=$nt;
		 echo"<ul>";
		   echo"<li ><a href=display.php?key1=$k1&&key=$val >".$k1."</a></li>";
		   echo"</ul>";
	 }*/
	 if(!isset($_GET['key1'])){
	 $sql="SELECT * FROM $val ";
$result = mysql_query($sql);


$ctr=5;
echo '<div class="filt">';
echo  '<h4><b><center>Price</center></b></h4>';
echo '<ul class="list-group">';




while($ctr>0)
{

		   echo"<div class='list-group-item'><a href=display.php?key=$val&&key3=$ctr >".$ctr."</a></div>";               //filter
		   
		   $ctr--;
}
echo'</ul>';
echo "</div>";
    if(!isset($_GET['key3'])){
if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
echo '<div class="items">';
echo '<div class="row">';
while ($row = mysql_fetch_assoc($result)) {
    
	
	
	
	echo '<div class="col-sm-6 col-md-3">';
    echo '<div class="thumbnail">';
     echo ' <img src="'.$row['image'].'" alt="Xperia ZR" height="70" width="50">';
      echo '<div class="caption">';
       echo " <h3><center>".$row['name']."</center></h3>";
        echo '<p><center>&#8377 30,000</center></p>';
        echo '<p><center><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">Cart</a> <a href="#" class="btn btn-info" role="button">Specs</a></center></p>';
     echo ' </div>';
    echo '</div>';
  echo '</div>';
	
	
	
	
	
	//echo $row["name"];
	//$b= $row["image"];
	//echo '<img src="'. $row['image'].'" />';
}
echo '</div>';
echo '</div>';
	}
	if(isset($_GET['key3']))
	{
		$val4=$_GET['key3'];
		
		$val4=$val4*10;
		$val5=$val4 +10;
		 echo $val4;
		$sql4="SELECT * FROM $val where price BETWEEN '$val4' AND '$val5'";
		$result4 = mysql_query($sql4);
		if (mysql_num_rows($result4) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
echo '<div class="items">';
echo '<div class="row">';
while ($row4 = mysql_fetch_assoc($result4)) {

     echo '<div class="col-sm-6 col-md-3">';
    echo '<div class="thumbnail">';
     echo ' <img src="'.$row4['image'].'" alt="Xperia ZR" height="70" width="50">';
      echo '<div class="caption">';
       echo " <h3><center>".$row4['name']."</center></h3>";
        echo '<p><center>&#8377 30,000</center></p>';
        echo '<p><center><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">Cart</a> <a href="#" class="btn btn-info" role="button">Specs</a></center></p>';
     echo ' </div>';
    echo '</div>';
  echo '</div>';





	//echo $row4["name"];
	//echo '<img src="'. $row4['image'].'" />';
}
		
		
	}
	 }
	 
	 if(isset($_GET['key1'])){
		// echo $val;
		$val1=$_GET['key1'];
		 $ctr=5;
		 echo '<div class="filt">';
echo  '<h4><b><center>Price</center></b></h4>';
echo '<ul class="list-group">';
         while($ctr>0)
{
	// echo"<ul>";
		   echo"<div class='list-group-item'><a href=display.php?key=$val&&key3=$ctr&&key1=$val1 >".$ctr."</a></div>";
		  // echo"</ul>";
		   $ctr--;
}
		if(!isset($_GET['key3'])){
		  
		  //echo $val1;
		  $sql1="SELECT * FROM $val WHERE company = '$val1' ";
	 $result1 = mysql_query($sql1);

if (mysql_num_rows($result1) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
echo '<div class="items">';
echo '<div class="row">';
while ($row1 = mysql_fetch_assoc($result1)) {

	
	echo '<div class="col-sm-6 col-md-3">';
    echo '<div class="thumbnail">';
     echo ' <img src="'.$row1['image'].'" alt="Xperia ZR" height="70" width="50">';
      echo '<div class="caption">';
       echo " <h3><center>".$row1['name']."</center></h3>";
        echo '<p><center>&#8377 30,000</center></p>';
        echo '<p><center><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">Cart</a> <a href="#" class="btn btn-info" role="button">Specs</a></center></p>';
     echo ' </div>';
    echo '</div>';
  echo '</div>';

	
	//echo $row1["name"];
	//echo '<img src="'. $row1['image'].'" />';
}
	 
		}
		if(isset($_GET['key3']))
		{
			$val5=$_GET['key3'];
		
		$val5=$val5*10;
		$val6=$val5 +10;
		 //echo $val5;
		$sql5="SELECT * FROM $val where company='$val1' AND price BETWEEN '$val5' AND '$val6'";
		$result5 = mysql_query($sql5);
		if (mysql_num_rows($result5) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
echo '<div class="items">';
echo '<div class="row">';
while ($row5 = mysql_fetch_assoc($result5)) {

     echo '<div class="col-sm-6 col-md-3">';
    echo '<div class="thumbnail">';
     echo ' <img src="'.$row5['image'].'" alt="Xperia ZR" height="70" width="50">';
      echo '<div class="caption">';
       echo " <h3><center>".$row5['name']."</center></h3>";
        echo '<p><center>&#8377 30,000</center></p>';
        echo '<p><center><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">Cart</a> <a href="#" class="btn btn-info" role="button">Specs</a></center></p>';
     echo ' </div>';
    echo '</div>';
  echo '</div>';



	//echo $row5["name"];
	//echo '<img src="'. $row5['image'].'" />';
}
		}
 }

 }
 
 
?>

</body>
</html>
