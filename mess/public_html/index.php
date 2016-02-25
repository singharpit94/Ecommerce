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

$login = "false";
$type = "normal";

if (isset($_SESSION["email"])) {
    $login = "true";
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $phone = $_SESSION["phone"];
    $room = $_SESSION["room"];
    $roll = $_SESSION['roll'];
    $email = $_SESSION["email"];
    $type = $_SESSION["type"];
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
    if (mysqli_num_rows($query) != 1) {
        echo "You are not authorized to send feedback";
        exit();
    } else {

        $to = "shaunak1105@gmail.com";
        $from = $feedback_email;
        $subject = 'feedback mail';
        $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>
                    Feedback Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">'
            . $feedback_message .
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

    <!-- Latest compiled and minified CSS -->


    <!-- jquery -->


    <!-- Latest compiled and minified JavaScript -->

    <style>

        a:link {
            text-decoration: none;

        }

        a:visited {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            color: inherit;

        }

        a:active {
            text-decoration: none;
        }
        .card {
            background-color: #eeeeee;
            color: #000000;
            font-family: "Droid Sans", Helvetica, Arial, sans-serif;
        }

        blockquote {
            border-left: 5px solid #2CE432;
            color: #316F05;
        }

        .blockquote_contact_info {
            border-left: 5px solid cornflowerblue;
            color: #506fb4;
        }

        .blockquote_contact_us {
            border-left: 5px solid #f37187;
            color: #b15e5e;
        }

        .container-fluid .jumbotron {

            border-radius: 0;
        }

        .header {
            font-family: "Droid Sans Mono", Helvetica, Arial, sans-serif;
            border-radius: 0;
        }

        .header h2 {
            font-size: 40px;
            color: #3DBD00;
        }

        .header p {
            color: #506fb4;
        }

        .header .imp
        {
            color: #ff6557;
            text-transform: uppercase;
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

        #status {
            font-family: "Droid Sans", Helvetica, Arial, sans-serif;
            color: white;
        }

        .rules
        {
            border-left: 5px solid #ed817e;
            color: #cc5557;
        }

        .card-reveal
        {
            background-color: #F9D5CB!important;
        }

        .rules2
        {
            border-left: 5px solid #8287ed;
            color: #565fa8;
        }


    </style>

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

    <title>Home</title>
</head>

<body>
<!-- NAVBAR STARTS -->
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="copy.php">Fill Choice</a></li>
    <li><a href="mydetails.php">My Details</a></li>
    <li class="divider"></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<ul id="dropdown2" class="dropdown-content">
    <li><a href="copy.php">Fill Choice</a></li>
    <li><a href="mydetails.php">My Details</a></li>
    <li class="divider"></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>
<nav>
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">&nbsp;&nbsp;Tagore Hall Mess Online Portal</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
           
            <?php
            if ($type == "admin")
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
            <li><a href="http://hall2mess.esy.es/uploads/menu/menu.png" target="_blank">Mess Menu</a></li>
            <?php
            if ($type == "admin")
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
        <div class="jumbotron header hidden-xs hidden-sm hoverable">
            <h2>An Initiative to help the Students </h2>

            <p>Online Mess Management System</p>
            <p class="imp">Please fill up your choices </p>
            <?php
            if (isset($_SESSION['email'])) {
                echo '<p><a class="btn waves-effect waves-light" href="copy.php" role="button">Fill Up Your Choices</a></p>';
                echo '<p><a class="btn waves-effect waves-light" href="mydetails.php" role="button">My Details</a></p>';
                echo '<p><a class="btn waves-effect waves-light" href="logout.php" role="button">Log Out</a></p>';
            } else {
                echo '<p><a class="btn waves-effect waves-light" href="login.php" role="button">Click To Log In</a></p>';
            }
            ?>

        </div>
    </div>
    <div>
        <div class="visible-xs visible-sm">
            <br/><br/><br/><br/>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m5">
            <div class="card hoverable ">
                <div class="card-content">
                    <span class="card-title">Why complicate stuff?</span>

                    <p>Why do we need an online mess system anyways? The following points may convince you</p>
                    <blockquote>
                        Reduce the mess bill<br>
                        Pay only for the days in which you want to eat<br>
                        Reduces wastage of food and effort<br>
                        To increase the overall quality of food
                    </blockquote>
                </div>

            </div>
        </div>

        <div class="col s12 m3">
            <div class="card hoverable ">
                <div class="card-content">
                    <span class="card-title">Hall 3 Wardens</span>
                    <blockquote class="blockquote_contact_info">
                        Dr. S. Roy Burman<br>
                        Mobile: +91-9434789002<br>
                        Dr. Debasis Mitra<br>
                        Mobile: +91-9434789012
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card hoverable ">
                <div class="card-content">
                    <span class="card-title">Feel Free to Contact us</span>
                    <blockquote class="blockquote_contact_us">
                        Saurabh Kishore  &nbsp; Room no - 112<br>
                        Mobile: +91-9563416374<br><br>
                        Arpit &nbsp; Room no - 103<br>
                        Mobile: +91-9832821697<br><br>
                        Abhijeet &nbsp; Room no - 123<br>
                        Mobile: +91-8158844689<br><br>
                        Shaunak &nbsp; Room no - 123<br>
                        Mobile: +91-8481900767<br><br>

                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    


    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col s10 ">
            <div class="card hoverable">
                <div class="card-content">
                    <span class="card-title">Instructions.. </span>


                    <span class="card-title activator grey-text text-darken-4"><i
                            class="material-icons right">more_vert</i></span>
                    <p>But we know u don't really need them :P</p>
                    <blockquote class="rules">
                        Go to the Login Page<br>
                        If you are a new user register yourself<br>
                        Enter a valid working mail id and click on the link in the mail received once you sign up<br>
                        Log In with the password you selected in the Sign Up page<br>
                        Fill Your choices. Tentatively you will be allowed to fill choices b/w 25th - 30th each month<br>
                        Submit and enjoy<br>
                    </blockquote>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Some Important Points to keep in mind<i class="material-icons right">close</i></span>
                    <blockquote class="rules2">
                        If you don't fillup your choices we consider your default option(veg or non veg) for everyday of the month<br>
                        On the basis of your choices you will be receiving tokens<br>
                        Please ensure that the email id you have provided us is working and secure<br>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-1"></div>
</div>

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