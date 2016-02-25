<?php

require_once("../resources/config.php");
function redirect_to($url)
{
    header('Location: ' . $url);
}

function logs($str)
{
    $myfile = fopen("log.txt", "a") or die("Unable to open file!");
    $txt = date("[D M j G:i:s T Y]\n");
    fwrite($myfile, $txt);
    fwrite($myfile, "$str\n\n");
    fclose($myfile);
}

///////////////////////////////////////////////////////////////////////
$year = date("Y");
$mon = date("M");
$monthName = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
if ($year % 400 == 0)
    $leap = "yes";
else if ($year % 100 == 0)
    $leap = "no";
else if ($year % 4 == 0)
    $leap = "yes";
else
    $leap = "no";
if ($leap == "yes")
    $monthSize = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
else
    $monthSize = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
///////////////////////////////////////////////////////////////////////

if ($_SESSION["email"]) {
    $login = "true";
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $phone = $_SESSION["phone"];
    $room = $_SESSION["room"];
    $roll = $_SESSION['roll'];
    $email = $_SESSION["email"];
    $type = $_SESSION["type"];


    //CHECKING VALIDITY OF USER
    $sql = "select * from fillup where email='$email';";
    $query = query($sql);
    confirm($query);
    $sumveg = 0;
	$sumnveg = 0;
    $fee;
} else {
    redirect_to("index.php");
    exit();
}


if (isset($_POST['m'])) {
    $feedback_email = escape_string($_POST['e']);
    $feedback_message = escape_string($_POST['m']);
    if ($feedback_email == "" || $feedback_message == "") {
        echo "The form submission is missing values.";
        exit();
    }
    $sql = "SELECT * FROM users_registered WHERE email='$feedback_email' LIMIT 1";
    $query = query($sql);
    confirm($query);
    if(mysqli_num_rows($query)!=1)
    {
        echo "You are not authorized to send feedback";
        exit();
    }

    else {

        $to = "shaunak1105@gmail.com";
        $from = $feedback_email;
        $subject = 'feedback mail';
        $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>
                    Feedback Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">'
                    .$feedback_message.
                    '</body></html>';
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        mail($to, $subject, $message, $headers);
        echo "mail_success";
        exit();
    }
}

if (isset($_POST["emailcheck"])) {
    //check entered mail against database

    $email = escape_string($_POST['emailcheck']);
    $query2 = query("SELECT * FROM users_registered WHERE email='$email' LIMIT 1");
    confirm($query2);

    $registered_email_check = mysqli_num_rows($query2);
    if ($registered_email_check == 1) {
        echo '<span style="color: #96aab4">Ok..You are a Registered user so you can send feedback</span>';
        exit();
    } else {
        echo '<span style="color: #a26a6d">You need to be a registered user to send feedback</span>';
        exit();
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!--Import materialize.css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/index.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/ajax.js"></script>
    <script src="js/main.js"></script>
    <style>
        body {
            background-color: #F9F9F9;
        }

        div.page {
            background-color: #fbfcfc;
            box-shadow: 0px 0px 10px #CECECE;
        }



        .text-cloud {
            color: #ecf0f1;
        }

        .chip_nonveg {
            background-color: #cd887f;
            color: #5c5c5c;
            font-family: Ubuntu, sans-serif;
            font-weight: bold;

        }

        .veg{
            background-color: #99d98b;
            color: #5c5c5c;
            font-family: Ubuntu, sans-serif;
            font-weight: bold;
        }

        .none
        {
            background-color: #7accd9;
            color: #5c5c5c;
            font-family: Ubuntu, sans-serif;
            font-weight: bold;
        }
        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 0;
            border-radius: 0;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .panel-primary>.panel-heading {
            color: #313030;
            background-color: cornflowerblue;
            /* border-color: #337ab7; */
        }

        .panel-heading {
            padding: 10px 15px;
            border-bottom: 0 solid transparent;
            /* border-bottom: 1px solid transparent; */
            /* border-top-left-radius: 3px; */
            /* border-top-right-radius: 3px; */
            font-family: "Droid Sans Mono", Helvetica, Arial, sans-serif;
        }

        .panel-body
        {
            font-family: Ubuntu, sans-serif;
        }

        .form_header {
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #e3dad7;
        }

        .input {
            display: flex;
            align-items: center;
            transition: background .3s ease-in-out;
        }

        .button {
            height: 44px;
            border: none;
        }

        #email {
            width: 100%;
            font-family: inherit;
            color: #737373;
            letter-spacing: 1px;
            text-indent: 5%;

        }

        #pass1 {
            margin-top: 10px;
            height: 120px;

            font-family: inherit;
            color: #737373;
            letter-spacing: 1px;
            text-indent: 5%;

        }

        #submit {

            margin-top: 10px;
            height: 46px;
            background: #54D04C;
            font-family: inherit;
            font-weight: bold;
            letter-spacing: 1px;
            line-height: 46px;
            cursor: pointer;
            transition: background .3s ease-in-out;
            color: #fcfcfc;
            text-align: center;
        }

        #submit:hover {
            background: #44ae36;
        }

        input:focus {
            outline: 2px solid #5fff33;
            border-bottom: 0 solid transparent !important;
        }

        input[type="text"] {
            background-color: #eeffde;
            border-bottom: 0 solid transparent;
            transition: none;
        }

        input[type="password"] {
            background-color: #eeffde;
        }

        textarea {
            background-color: #eeffde;
        }

        footer.page-footer {
            background-color: #4E4D4D;
        }

        #emailstatus {
            font-family: Ubuntu, sans-serif;
            text-align: center;
            font-weight: 500;
            color: honeydew;
            font-size: 18px;
        }

        #status
        {
            font-family: "Droid Sans", Helvetica, Arial, sans-serif;
            color: white;
        }


    </style>
    <title>Home</title>
    <script>
        function restrict(elem) {
            var tf = _(elem);
            var rx = new RegExp;
            if (elem == "email") {
                rx = /[' "]/gi;
            }
            tf.value = tf.value.replace(rx, "");
        }
        function emptyElement(x) {
            _(x).innerHTML = "";
        }


        function checkEmail() {
            var e = _("email").value;
            if (e != "") {
                _("emailstatus").innerHTML = 'checking ...';
                var ajax = ajaxObj("POST", "index.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        _("emailstatus").innerHTML = ajax.responseText;
                    }

                }
                ajax.send("emailcheck=" + e);
            }
        }


        function sendFeedback() {
            var e = _("email").value;
            var m = _('pass1').value;

            var status = _("status").value;
            if (e == "" || m == "") {
                _("status").innerHTML = "Please fill out all of the form data";
            }
            else {
                // all ok
                _("submit").style.display = "none";
                _("status").innerHTML = "please wait";
                var ajax = ajaxObj("POST", "index.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        if (ajax.responseText != "mail_success") {
                            console.log(ajax.responseText);
                            _("status").innerHTML = ajax.responseText;
                            _("submit").style.display = "block";
                        }
                        else {
                            _("status").innerHTML = "Ok.. ur feedback has been recorded";
                            _("submit").style.display = "none";
                        }
                    }
                }
                ajax.send("e=" + e + "&m=" + m);
            }

        }

    </script>

</head>

<body>
<!-- NAVBAR STARTS -->
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="copy.php">Fill Choice</a></li>
    <li class="divider"></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<ul id="dropdown2" class="dropdown-content">
    <li><a href="copy.php">Fill Choice</a></li>
    <li class="divider"></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>
<nav>
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">&nbsp;&nbsp;Hall 2 Mess Portal</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="sass.html">Mess Menu</a></li>
            <?php
            if($type == "admin")
                echo '<li><a href="admin.php">Admin Panel</a></li>';
            ?>
            <!-- Dropdown Trigger -->
            <?php
            if (isset($_SESSION['email'])) {
                echo '<li ><a class="dropdown-button" href = "#!" data-activates = "dropdown1">' . $email . '<i class="material-icons right" > arrow_drop_down</i ></a ></li>';
            } else
                echo '<li><a href="login.php">Sign In</a></li>';
            ?>

        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="sass.html">Mess Menu</a></li>
            <?php
            if($type == "admin")
                echo '<li><a href="admin.php">Admin Panel</a></li>';
            ?>
            <!-- Dropdown Trigger -->
            <?php
            if (isset($_SESSION['email'])) {
                echo '<li ><a class="dropdown-button" href = "#!" data-activates = "dropdown2">' . $email . '</a ></li>';
            } else
                echo '<li><a href="login.php">Sign In</a></li>';
            ?>
        </ul>

    </div>
</nav>




<!-- NAVBAR ENDS -->



<div class="container-fluid">
<br>
    <div>
        <div class="visible-xs visible-sm">
            <br/><br/><br/><br/>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10 page hoverable">
            <div class="page-header">
                <h3 style="font-family: Ubuntu, sans-serif">Choice List
                    <small>...</small>
                </h3>
            </div>

            <div class="panel panel-primary hoverable">
                <div class="panel-heading">
                    <h3 class="panel-title">Full Name</h3>
                </div>
                <div class="panel-body"><?php echo $fname . " " . $lname; ?></div>
            </div>

            <div class="panel panel-primary hoverable ">
                <div class="panel-heading">
                    <h3 class="panel-title">Roll Number</h3>
                </div>
                <div class="panel-body"><?php echo $roll; ?></div>
            </div>

            <div class="panel panel-primary hoverable">
                <div class="panel-heading">
                    <h3 class="panel-title">Room Number</h3>
                </div>
                <div class="panel-body"><?php echo $room; ?></div>
            </div>

            <div class="panel panel-primary hoverable">
                <div class="panel-heading">
                    <h3 class="panel-title">Phone Number</h3>
                </div>
                <div class="panel-body"><?php echo $phone; ?></div>
            </div>

            <div class="panel panel-primary hoverable">
                <div class="panel-heading">
                    <h3 class="panel-title">Email id</h3>
                </div>
                <div class="panel-body"><?php echo $email; ?></div>
            </div>

            <table class="table">
                <thead>
                    <th>Day</th>
                    <th>Choice Lunch</th>
					 <th>Choice Dinner</th>
                </thead>

                <?php
                $sql1 = "select id from month";
                $query1 = query($sql1);
                confirm($query1);
                $row1 = fetch_array($query1);
                $month = $row1["id"];

                if (mysqli_num_rows($query) > 0) {
                    $row = fetch_array($query);
                    for ($i = 1; $i <= $monthSize[$month - 1]; $i++) {
                        $str = "day" . $i;
                        if (($row[$str]%10)> 1)
                            echo " ";
                        if (($row[$str]%10) == 1 && round($row[$str]/10)==1)
                            echo '
									<tr>
										<td>Day ' . $i . '</td>
										<td>
										<div class="chip none">None</div></td>
										<td>
										<div class="chip none">None</div></td>
										
									</tr>
								';
                        else if (round($row[$str]/10) == 1 && ($row[$str]%10)==2)
						{  echo '
									<tr>
										<td style="color: #5f9a55; font-family: Ubuntu, sans-serif">Day ' . $i . '</td>
										<td><div class="chip veg">None</div></td>
										
										<td><div class="chip veg">Veg</div></td>
									</tr>
						';
						      $sumveg++;
						}
                        else if (round($row[$str]/10) == 1 && ($row[$str]%10)==3)
						{ echo '
									<tr>
										<td style="color: #5f9a55; font-family: Ubuntu, sans-serif">Day ' . $i . '</td>
										<td><div class="chip veg">None</div></td>
										
										<td><div class="chip_nonveg">Non Veg</div></td>
									</tr>
								';
								$sumnveg++;
						}
								else if (round($row[$str]/10) == 2 &&($row[$str]%10)==1)
								{echo '
									<tr>
										<td style="color: #5f9a55; font-family: Ubuntu, sans-serif">Day ' . $i . '</td>
										<td><div class="chip veg">Veg</div></td>
										
										<td><div class="chip veg">None</div></td>
									</tr>
								';
								$sumveg++;
								}
								else if (round($row[$str]/10) == 2 && ($row[$str]%10)==2)
								{ echo '
									<tr>
										<td style="color: #5f9a55; font-family: Ubuntu, sans-serif">Day ' . $i . '</td>
										<td><div class="chip veg">Veg</div></td>
										
										<td><div class="chip veg">Veg</div></td>
									</tr>
								';
								$sumveg+=2;
								}
								else if (round($row[$str]/10) == 2 && ($row[$str]%10)==3)
								{echo '
									<tr>
										<td style="color: #5f9a55; font-family: Ubuntu, sans-serif">Day ' . $i . '</td>
										<td><div class="chip veg">Veg</div></td>
										
										<td><div class="chip_nonveg">Non Veg</div></td>
									</tr>
								';
								$sumveg++;
								$sumnveg++;
								}
								else if (round($row[$str]/10) == 3 && ($row[$str]%10)==1)
								{ echo '
									<tr>
										<td style="color: #5f9a55; font-family: Ubuntu, sans-serif">Day ' . $i . '</td>
										<td><div class="chip_nonveg">Non Veg</div></td>
										
										<td><div class="chip veg">None</div></td>
									</tr>
								';
								$sumnveg++;
								}
								else if (round($row[$str]/10) == 3 && ($row[$str]%10)==2)
								{echo '
									<tr>
										<td style="color: #5f9a55; font-family: Ubuntu, sans-serif">Day ' . $i . '</td>
										<td><div class="chip_nonveg">Non Veg</div></td>
										
										<td><div class="chip veg">Veg</div></td>
									</tr>
								';
								$sumnveg++;
								$sumveg++;
								}
								else if (round($row[$str]/10) == 3 && ($row[$str]%10)==3)
								{echo '
									<tr>
										<td style="color: #5f9a55; font-family: Ubuntu, sans-serif">Day ' . $i . '</td>
										<td><div class="chip_nonveg">Non Veg</div></td>
										
										<td><div class="chip_nonveg">Non Veg</div></td>
									</tr>
								';
								$sumnveg+=2;
								}
                    }
                }
                else
                {
                    exit();
                }
                ?>
            </table>

            <div class="page-header">
                <h4 style="font-family: Ubuntu, sans-serif">Total number of tokens
                    <small>...</small>
                </h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php
                        echo "Veg  ".$sumveg."    Non Veg ".$sumnveg;
                        ?>
                    </div>
                </div>
            </div>

            <div class="page-header">
                <h4 style="font-family: Ubuntu, sans-serif">Total fees
                    <small>...</small>
                </h4>
                <div class="panel panel-default">
                    <div class="panel-body">

                        <?php
                        $sql = "select * from cost where email = '$email'";
                        $result = query($sql);
                        confirm($result);

                        if(mysqli_num_rows($result) > 0) {
                            $row = fetch_array($result);
                            $fee = $row["cost"];
                            $t = ($month - 2);
                            if ($t < 0)
                                $t += 12;
                            echo "Total fees for the month of " . $monthName[$t] . " is Rs " . $fee;
                        }
                        else
                        {
                            echo "Your month fee is yet to be calculated";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-1"></div>
    </div>
    <br/><br/><br/><br/>

</div>

<footer class="page-footer">

    <form name="sign up for beta form" onsubmit="return false;">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <div class="form_header">
                    <p>Have a Feedback? Drop in a mail...</p>
                </div>
            </div>
            <div class="col-xs-4"></div>
        </div>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <div class="input">
                    <input type="text" class="button" id="email" onfocus="emptyElement('emailstatus')"
                           onblur="checkEmail()" onkeyup="restrict('email')" maxlength="88" name="email"
                           placeholder="NAME@EXAMPLE.COM">
                </div>
            </div>
            <div class="col-xs-4"></div>
        </div>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4" id="emailstatus"></div>
            <div class="col-xs-4"></div>
        </div>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <div class="input">
                    <textarea class="button" id="pass1" cols="4" name="password"
                              placeholder="ENTER YOUR MESSAGE"></textarea>
                </div>
            </div>
            <div class="col-xs-4"></div>
        </div>
        <div class="row">
            <div class="col-xs-5"></div>
            <div id="submit" onclick="sendFeedback()" class="col-xs-2">Send feedback</div>
            <div class="col-xs-5"></div>
        </div>
        <div class="row">
            <div class="col-xs-4"></div>
            <div id="status" class="col-xs-4"></div>
            <div class="col-xs-4"></div>
        </div>
    </form>

    <div class="footer-copyright">
        <div class="container">
            © 2014 Copyright Text
        </div>
    </div>
</footer>
<script src="js/jquery.min.js"></script>

<script src="js/materialize.min.js"></script>
<script>
    $(".button-collapse").sideNav();
</script>
</body>
</html>