<?php
require_once("../resources/config.php");
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
		
		if($type!="admin"){
			redirect_to("index.php");
			exit();
		}
	}
	else{
		redirect_to("index.php");
		exit();
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
									<li><a href="fillup.php">Fill Choice</a></li>
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
					<h1>Admin <small>...</small></h1>
				</div>
				
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Open student info</h3>
					</div>
					<div class="panel-body"><a href="student.php" target="_blank">Student info for this month</a>
					</div>
				</div>
				
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Open list of per day meals!!</h3>
					</div>
					<div class="panel-body"><a href="perdaymeals.php" target="_blank">Per day meals info for this month</a>
					</div>
				</div>
				
				<?php
					$sql = "select * from enable";
					$query = query($sql);
                    confirm($query);
                    $row = fetch_array($query);
                    $statusEnable = $row['status'];
					if($statusEnable)
						echo '
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">Gateway Status</h3>
								</div>
								<div class="panel-body">Open
								</div>
							</div>
						';
					else
						echo '
							<div class="panel panel-danger">
								<div class="panel-heading">
									<h3 class="panel-title">Gateway Status</h3>
								</div>
								<div class="panel-body">Closed
								</div>
							</div>
						';
				?>
				
				<!--openGateway-->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Open Gateway!!</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="opengateway.php">
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
											<input type="checkbox" name="checkbox"> Are you damn sure wanna init??
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default">Sign in</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				<!--closeGateway-->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Close Gateway!!</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="closegateway.php">
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
											<input type="checkbox" name="checkbox"> Are you damn sure wanna init??
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default">Sign in</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				<!--openGateway-->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Calculate!!</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="cost.php">
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
								<label for="inputEmail3" class="col-sm-2 control-label">Total Cost</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Cost" name="totalcost">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="checkbox"> Are you damn sure wanna init??
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default">Sign in</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Perform init!!</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="init.php">
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
											<input type="checkbox" name="checkbox"> Are you damn sure wanna init??
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default">Sign in</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Daywise tokens</h3>
					</div>
					<table class="table">
						<tr>
							<th>Day</th>
							<th>Tokens(Lunch)</th>
							<th>Veg(Lunch)</th>
							<th>Non Veg(Lunch)</th>
							<th>Tokens(Dinner)</th>
							<th>Veg(Dinner)</th>
							<th>Non Veg(Dinner)</th>
						</tr>
						<?php

							$sql="select * from month";
							$query = query($sql);
                            confirm($query);
                            $row = fetch_array($query);
                            $month = $row['id'];
							$half=$row['half'];							
							 if($half==1)
		   {
        for ($i = 1; $i <= 15; $i++) {
            $str = "day" . $i;
            $sql1 = "select count($str) as total_lunch from fillup where $str = 21 or $str = 22 or $str = 23  or $str = 31  or $str = 32  or $str = 33";
            $sql2 = "select count($str) as veg_lunch from fillup where $str = 21  or $str = 22  or $str = 23";
            $sql3 = "select count($str) as nonveg_lunch from fillup where $str = 31  or $str = 32  or $str = 33";
			$sql4 = "select count($str) as total_dinner from fillup where $str = 12 or $str = 13 or $str = 22  or $str = 23  or $str = 32  or $str = 33";
            $sql5 = "select count($str) as veg_dinner from fillup where $str = 12  or $str = 22  or $str = 32";
            $sql6 = "select count($str) as nonveg_dinner from fillup where $str = 13  or $str = 23  or $str = 33";
            $result1 = query($sql1);
            confirm($result1);
            $result2 = query($sql2);
            confirm($result2);
            $result3 = query($sql3);
            confirm($result3);
			$result4 = query($sql4);
            confirm($result4);
            $result5 = query($sql5);
            confirm($result5);
            $result6 = query($sql6);
            confirm($result6);
            if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0 && mysqli_num_rows($result4) > 0 && mysqli_num_rows($result5) > 0 && mysqli_num_rows($result6) > 0) {
                $row1 = $result1->fetch_assoc();
                $row2 = $result2->fetch_assoc();
                $row3 = $result3->fetch_assoc();
				$row4 = $result4->fetch_assoc();
                $row5 = $result5->fetch_assoc();
                $row6 = $result6->fetch_assoc();


                echo "
										<tr>
											<td>$i</td>
											<td>" . $row1["total_lunch"] . "</td>
											<td>" . $row2["veg_lunch"] . "</td>
											<td>" . $row3["nonveg_lunch"] . "</td>
											<td>" . $row4["total_dinner"] . "</td>
											<td>" . $row5["veg_dinner"] . "</td>
											<td>" . $row6["nonveg_dinner"] . "</td>
										</tr>
									";
            }
        }
		   }
		   else
		   {
			    for ($i = 16; $i <= $monthSize[$month-1]; $i++) {
            $str = "day" . $i;
            $sql1 = "select count($str) as total_lunch from fillup where $str = 21 or $str = 22 or $str = 23  or $str = 31  or $str = 32  or $str = 33";
            $sql2 = "select count($str) as veg_lunch from fillup where $str = 21  or $str = 22  or $str = 23";
            $sql3 = "select count($str) as nonveg_lunch from fillup where $str = 31  or $str = 32  or $str = 33";
			$sql4 = "select count($str) as total_dinner from fillup where $str = 12 or $str = 13 or $str = 22  or $str = 23  or $str = 32  or $str = 33";
            $sql5 = "select count($str) as veg_dinner from fillup where $str = 12  or $str = 22  or $str = 32";
            $sql6 = "select count($str) as nonveg_dinner from fillup where $str = 13  or $str = 23  or $str = 33";
            $result1 = query($sql1);
            confirm($result1);
            $result2 = query($sql2);
            confirm($result2);
            $result3 = query($sql3);
            confirm($result3);
			$result4 = query($sql4);
            confirm($result4);
            $result5 = query($sql5);
            confirm($result5);
            $result6 = query($sql6);
            confirm($result6);
            if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0 && mysqli_num_rows($result4) > 0 && mysqli_num_rows($result5) > 0 && mysqli_num_rows($result6) > 0) {
                $row1 = $result1->fetch_assoc();
                $row2 = $result2->fetch_assoc();
                $row3 = $result3->fetch_assoc();
				$row4 = $result4->fetch_assoc();
                $row5 = $result5->fetch_assoc();
                $row6 = $result6->fetch_assoc();


                echo "
										<tr>
											<td>$i</td>
											<td>" . $row1["total_lunch"] . "</td>
											<td>" . $row2["veg_lunch"] . "</td>
											<td>" . $row3["nonveg_lunch"] . "</td>
											<td>" . $row4["total_dinner"] . "</td>
											<td>" . $row5["veg_dinner"] . "</td>
											<td>" . $row6["nonveg_dinner"] . "</td>
										</tr>
									";
            }
        }
		   }

						?>
					</table>
				</div>
				
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