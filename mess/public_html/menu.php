<?php
require_once("../resources/config.php");
	session_start();
	function redirect_to($url)
	{
	header('Location: '.$url);
	}
	
	function logs($str){
		$myfile = fopen("log.txt", "a") or die("Unable to open file!");
		$txt = date("[D M j G:i:s T Y]\n");
		fwrite($myfile, $txt);
		fwrite($myfile, "$str\n\n");
		fclose($myfile);
	}
	
	///////////////////////////////////////////////////////////////////////
	$year = date("Y");
	$mon = date("M");
	$monthName = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	if ( $year % 400 == 0)
		$leap = "yes";
	else if ($year%100 == 0)
		$leap = "no";
	else if ($year%4 == 0 )
		$leap = "yes";
	else
		$leap = "no";
	if( $leap == "yes")
		$monthSize = array(31,29,31,30,31,30,31,31,30,31,30,31);
	else
		$monthSize = array(31,28,31,30,31,30,31,31,30,31,30,31);
	///////////////////////////////////////////////////////////////////////
	
	if($_SESSION["email"])
	{
		$login="true";
		$fname=$_SESSION["fname"];
		$lname=$_SESSION["lname"];
		$phone=$_SESSION["phone"];
		$room= $_SESSION["room"];
		$roll=$_SESSION['roll'];
		$email=$_SESSION["email"];
		$type=$_SESSION["type"];
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	
	
	<!-- jquery -->
	<script src="js/jquery.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	
	<style>
	body {
    background-color: #bdc3c7;
	}
	div.page{
	background-color: #fbfcfc;
	box-shadow: 0px 0px 10px grey;
	}
	.colp{
	background-color: #34495e;
	}
	.text-cloud{
	color: #ecf0f1;
	}
	</style>
	<title>Home</title>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<nav class="navbar navbar-default navbar-fixed-top">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="index.php">iDEAS</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav">
					<li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
					<li><a href="menu.php">Mess Menu</a></li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
					  <ul class="dropdown-menu">
						<?php
							if($type == "admin")
								echo "<li><a href='admin.php'>Admin</a></li>";
						?>
						
						<li><a href="feedback.php">Feedback</a></li>
						<li><a href="faq.php">FAQ</a></li>
						<li><a href="aboutus.php">About Us</a></li>
					  </ul>
					</li>
				  </ul>
				  
				  <ul class="nav navbar-nav navbar-right">
					<?php
						if($login == "true")
							echo '
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$email.' <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">My Wall</a></li>
									<li><a href="copy.php">Fill Choice</a></li>
									<li><a href="mydetails.php">My Details</a></li>
									<li role="separator" class="divider"></li>
									<li id="logout"><a href="logout.php">LOG OUT</a></li>
								</ul>
								</li>
							';
						else
							echo '
								<li><a href="login.php">Sign in</a></li>
							';
					?>
					
				  </ul>
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</div>
		
		<div>
			<div class="jumbotron text-cloud colp hidden-xs hidden-sm">
			  <h1>Mess</h1>
			  <p>we the people</p>
			  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
			</div>
		</div>
		<div>
			<div class="visible-xs visible-sm">
				<br /><br /><br /><br />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 page">
				<div class="page-header">
					<h1>List mess menus <small>...</small></h1>
				</div>
				<?php
				
				if($type == "admin")
					echo '
					<form action="uploadtry.php" method="post" enctype="multipart/form-data" class="form-horizontal">
						 <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
							<input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
							<input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
							</div>
						</div>
						 
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
								<input type="checkbox" name="checkbox"> Attach a file
								</label>
							</div>
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputFile" class="col-sm-2 control-label">File input</label>
							<input type="file" id="exampleInputFile" name="fileToUpload">
							<p class="help-block col-sm-10">Example block-level help text here.</p>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Upload</button>
							</div>
						</div>
					</form><hr>
					';
				

				$sql="select id from month";
				$result = query($sql);
                confirm($result);
				$row = fetch_array($result);
				$month=$row["id"];
				
				$sql="select * from menu order by id desc;";
				$result=query($sql);
                confirm($result);
				
				if(mysqli_num_rows($result)>0){
					$row = $result->fetch_assoc();
						echo '
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">Mess Menu for this month of '.$monthName[ $month - 1 ].' is</h3>
							</div>';
						echo '
							<div class="panel-body"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span><a href="'.$row["link"].'"> '.$row["name"].'</a></div>
							</div>';
					
				}
				?>
				
				  
			</div>
			<div class="col-xs-1"></div>
		</div>
		<br /><br /><br /><br />
		<div class="row">
			<nav class="navbar navbar-default navbar-fixed-bottom">
			  <div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <a class="navbar-brand">Semantic Web Technologies, NIT Durgapur</a>
				</div>
			  </div><!-- /.container-fluid -->
			</nav>
		</div>
		
	</div>


	
</body>
</html>