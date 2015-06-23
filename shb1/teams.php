<!DOCTYPE html>
<?php require_once("include/connection.php"); ?>
<?php include("include/function.php");?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Teams</title>

  <!--For MenuBar-->
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/bar.css">

<link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">
<style >
	body {
		   background: rgba(31, 29, 25, 0.4);
		}
    .details{
       background:rgba(255,255,255,0.4);
       width:900px;
  
       box-shadow: 0 0 25px 0 rgba(0, 0, 0, 0.5);
    }
  .nk{
  	border-bottom: 1px solid black;
  	height: 8px;
  }
  body {
	background: url(Images/nk.jpg) no-repeat center center fixed #000; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
     background-size: 100% 100%;
     overflow: hidden;
    }
.ch{
	border-bottom: 2px solid red;
	text-align: center;
}
.chnk{
       position:relative;
       left:40px;
       top:0px;
}
.description{
	font-size: 20px;
	height:40px;
}
.down{
	position:absolute;
	top:520px;
	left:800px;
}
.inside{
       position:relative;
       right:30px;
}
}
</style>


</head>
<body>

<!--Menubar-->
<div class="start panel clearfix" style="background:rgba(255,255,255,0.1)">

<div id="wrapper" class="left">
	
	<div class="mobile">
		<!-- Checkbox to toggle the menu -->
		<input type="checkbox" id="tm" />
       
      <ul class="sidenav">
        <?php
		$tn=$_SESSION['teams'];
			echo"<div>";
		foreach($tn as $key=>$nt)
		{
		  $k=$key;
		   echo"<li><a href=teams.php?key=$k><i class='fa fa-check'></i><b>".$nt."</b></a></li>";
		}
		   echo"<br/><br/><br/><br/>";
		?>
		
      </ul>
		<section>
<label for="tm">TEAM-STATUS</label>
  </section>
  </div>
  </div>

  <div class="right">
  <div class="pannel details style='background:rgba(255,255,255,0.1);' ">
  	<h2>
	   <?php
	     if(isset($_GET['key']))
		 {
		  $key=$_GET['key'];
		 echo'<ul class="pricing-table">';
          echo'<li class="title">TEAM-'.$key.'</li>';
		  $_SESSION['teamno']=$key;
		 }
		 ?>
	</h2>
  	<p>
	<?php
	if(isset($_GET['key']))
	{
	  $key=$_GET['key'];
	       $sub="SELECT * FROM list WHERE id='$key'";
	        $results=mysql_query($sub,$connection);
			if(!$results){
		       die("database query failed".mysql_error());
		        }
				echo'<div class="panel done clearfix" style="background:rgba(255,255,255,0.1);">';
			 //echo "<tr><td> id</td><td>  name</td><td>  money</td><td>  play</td></tr></br>  ";
              $row=mysql_fetch_array($results);
              $count=$row["total"];
		     if($count>0)
		     {
              $counter = 1;
              echo "<div class='left' style='height:510px'>";
			   echo '<table class="chnk"><thead>
			   <tr>
               <th width="250" class="ch">PLAYERS</th>
                </tr></thead>
                <tbody>';
			  while($counter<=$count)
			  {
			       echo "<tr class='nk'><td style='line-height:13px'>".utf8_encode($row["$counter"])."</td><td>" ;
				   
			     $counter++; 
			  }
			  echo'</tbody>
			  </table>';
			  echo'</div>';

			  echo'<div class="right">';

			      echo'<ul class="pricing-table inside">';
                  echo'<li class="title">STATUS</li>';
                  echo "<li class='price'>"."BUDGET: ".$row["budget"]."</li>";                   
	              echo "<li class='description'><h6>"."GOAL KEEPERS: ".$row["goal"]."</h6></li>";
		          echo "<li class='description'><h6>"."FORWARDS: ".$row["strike"]."</h6></li>";
		          echo "<li class='description'><h6>"."DEFENDERS: ".$row["ford"]."</h6></li>";
		          echo "<li class='description'><h6>"."MID FIELDERS: ".$row["mid"]."</h6></li>";
		          echo "<li class='description'><h6>"."OTHERS: ".$row["rest"]."</h6></li>";
		          echo "<li class='description'><h6>"."TOTAL: ".$row["total"]."</h6></li>";
		          	      
		          //echo "<li class='description'>"."Points   ".$row["points"]."</li>";
		          echo "<li class='description'><h6>"."PENALTY: ".$row["penality"]."</h6></li>";
				  if($row["captain"]!=NULL)
		          echo "<li class='description'><h6>"."CAPTAIN: ".utf8_encode($row["captain"])."</h6></li>";
		        echo"</ul>";
				echo"</div>";
	     if($count>=15&&$row["captain"]==NULL)
              {		 
				$sup="SELECT  * FROM list WHERE id='$key'" ;
	          $result=mysql_query($sup,$connection);
			if(!$result){
		       die("database query failed".mysql_error());
		        }
				
		   echo'<a href="#" data-reveal-id="myModal"class="button small secondary down">CHOOSE CAPTAIN</a>
           <div id="myModal" class="reveal-modal" data-reveal>
           <h2>PLAYERS</h2>';
                    
	       echo'<form action="next.php" method="POST">';
		   echo'<div>';
           echo'<select name="captain">';
			 //echo "<tr><td> id</td><td>  name</td><td>  money</td><td>  play</td></tr></br>  ";
              $row=mysql_fetch_array($result);
			  $v=0;
	           $v1='SELECT';
	           echo "<option value =$v>$v1</option>";
			   $count=$row["total"];
              $counter = 1;
			  while($counter<=$count)
			  {            
			              $var=$row["$counter"];
						  echo '<option value="'.utf8_encode($var).'">'.utf8_encode($var).'</option>';
						  $counter++;
              }
	   
	       echo"</select>";
	        echo"</div>";
	        echo"<button class='midium success'>SUBMIT</button>";
	        echo"</form>";
	        echo'<a class="close-reveal-modal">&#215;</a>
                     </div>';
	        }
	      }
	      else 
	      {
	      	echo"<h1 class='small-6 small-offset-3 columns'>NO PLAYERS</h1>";
	      }
	 }
  ?>
	</p>
  </div>
  </div>
  </div>
  <a href="bid.php"><div class="button small" style="postion:relative;left:385px;top:680px">BACK</div></a>
  <a href="show.php"><div class="button small alert" style="postion:relative;left:1052px;top:680px">!GAME OVER</div></a>
  <!--  <div class="small"><a href=select.html >BID AGAIN!</a></p></div>
  	<div class="small"><a href=show.php>GAME OVER</a></div> -->
  	<script src="js/jquery.js"></script>
  <script src="js/foundation.js"></script>
  <script src="js/foundation.reveal.js"></script>
  <!-- Other JS plugins can be included here -->

  <script>
    $(document).foundation();
  </script>
</body>

<?php require("include/close.php");?>
</html>