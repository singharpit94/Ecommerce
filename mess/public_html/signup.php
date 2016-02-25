<?php
require_once("../resources/config.php");

function redirect_to($url)
{
header('Location: ' . $url);
}
?>
<?php
$sign = "false";
function logs($str)
{
    $myfile = fopen("log.txt", "a") or die("Unable to open file!");
    $txt = date("[D M j G:i:s T Y]\n");
    fwrite($myfile, $txt);
    fwrite($myfile, "$str\n\n");
    fclose($myfile);
}

///////////////////////////////////////////////////////////////////////
// is leap yr calculation necessary here?
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

if (isset($_SESSION["email"])) {
    redirect_to("index.php");
    exit();
}

if (isset($_POST["emailcheck"])) {
    $email = escape_string($_POST['emailcheck']);
    $query = query("SELECT * FROM users WHERE email='$email' LIMIT 1");
    confirm($query);

    $email_check = mysqli_num_rows($query);
    $query2 = query("SELECT * FROM users_registered WHERE email='$email' LIMIT 1");
    confirm($query2);

    $registered_email_check = mysqli_num_rows($query2);
    if ($email_check < 1) {
        echo $email . ' is not in our database';
        exit();
    } else if ($registered_email_check == 1) {
        echo '<span style="color: #b42a11">You are already registered in This Site. Log in <a href="#" style="color: #122b40">Here</a></span>';
        exit();
    } else {
        echo '<span style="color: #006400">' . $email . ' is Ok</span>';
        exit();
    }
}


// Ajax calls this REGISTRATION code to execute
if (isset($_POST["e"])) {
    // CONNECT TO THE DATABASE
    $e = escape_string($_POST['e']);
    $p = $_POST['p'];
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $pn = $_POST['pn'];
    $r = $_POST['r'];
    $rm = $_POST['rm'];
    $c = $_POST['c'];

    $fn = escape_string($fn);
    $pn = escape_string($pn);
    $ln = escape_string($ln);
    $r = escape_string($r);
    $query = query("SELECT * FROM users WHERE email = '$e' LIMIT 1");
    confirm($query);
    $e_check = mysqli_num_rows($query);
    $query2 = query("SELECT * FROM users_registered WHERE email='$e' LIMIT 1");
    confirm($query2);
    $already_registered_check = mysqli_num_rows($query2);
    // FORM DATA ERROR HANDLING
    if ($e == "" || $p == "" || $fn == "" || $pn == "" || $ln == "" || $r =="" || $rm =="" || $c =="") {
        echo "The form submission is missing values.";
        exit();
    } else if ($e_check != 1) {
        echo "Sorry you are not added in our database";
        exit();
    } else if ($already_registered_check > 0) {
        echo "You have already registered in our site. Please proceed to Log In Page";
        exit();
    } else if (strlen($pn) != 10) {
        echo "please enter 10 digit mobile number";
        exit();
    } else if (strlen($p) <= 7) {
        echo "your password is too short";
        exit();

    } else if(strlen($rm)>3){
        echo "Room no cant be more than 3 digits long";
        exit();
    }
    else {
        // END FORM DATA ERROR HANDLING
        // Begin Insertion of data into the database
        // Hash the password and apply your own mysterious unique salt

        $p_hash = md5($p);
        // Add user info into the database table for the main site table
        $query = query("INSERT INTO users_registered (first_name,last_name,roll_no,room_no,phone_no,food,email,password) VALUES('$fn','$ln','$r','$rm','$pn','$c','$e','$p_hash')");
        confirm($query);
        $uid = get_id();
        //echo '<a href="activation.php?id=' . $uid . '&e=' . $e . '&p=' . $p_hash . '">Click here </a>';
        $to = "$e";
        $from = "hall2mess";
        $subject = 'Hall 2 mess Activation';
        $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>
                    Hall 2 Mess System Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
                    <div style="padding:10px; background:#333; font-size:24px; color:#CCC;">
                    <a style="color: #c3c0b9; text-decoration: none" href="http://hall2mess.esy.es">
                    Hall 2 Online Mess System Account Information</a></div>
                    <div style="padding:24px; font-size:17px;">Hello ' . $uid . ',<br /><br />
                    Click the link below to activate your account when ready:<br /><br />
                    <a href="http://hall2mess.esy.es/activation.php?id=' . $uid .  '&e=' . $e . '&p=' . $p_hash . '">Click here to activate your account now</a>
                    <br /><br />Login after successful activation using your:<br />* E-mail Address: <b>' . $e . '</b></div></body></html>';
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        mail($to, $subject, $message, $headers);
        echo "signup_success";
		//echo "<br/><a href='index.php'>Proceed to Login</a>";
		
		
        exit();
    }
    exit();
}

?>

<html>

<head>
    <meta charset="utf-8">
    <title>Sign Up For Beta Form</title>

    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="css/try_form.css">
    <script src="js/ajax.js"></script>
    <script src="js/main.js"></script>
    <script>
        function restrict(elem) {
            var tf = _(elem);
            var rx = new RegExp;
            if (elem == "email") {
                rx = /[' "]/gi;
            } else if (elem == "username") {
                rx = /[^a-z0-9]/gi;
            }

            else if (elem == "firstname") {
                rx = /[^a-z]/gi;
            }
            else if (elem == "lastname") {
                rx = /[^a-z]/gi;
            }

            else if (elem == "phonenumber") {
                rx = /[^0-9]/gi;
            }
            else if (elem == "roll") {
                rx = /[^0-9A-Z/]/gi;
            }
            else if (elem == "room"){
                rx = /[^0-9]/gi;
            }

            tf.value = tf.value.replace(rx, "");
        }
        function emptyElement(x) {
            _(x).innerHTML = "";
        }

        function validate_number_length() {
            var phone = _('phonenumber').value;
            var phone_length = phone.length;
            var x = _('phone_length_status');
            if (phone_length >= 1 && phone_length != 10) {
                x.innerHTML = "enter a 10 digit mobile number";
            }
            else {
                x.innerHTML = "";
            }
        }

        function validate_room_length() {
            var room = _('room').value;
            var room_length = room.length;
            var x = _('roomstatus');
            if (room_length>3) {
                x.innerHTML = "Room no cant have more than 3 digits";
            }
            else {
                x.innerHTML = "";
            }
        }

        function validate_length() {
            var pass = _('pass1').value;
            var pass_length = pass.length;
            var x = _('length_status');
            if (pass_length >= 1 && pass_length <= 7) {
                x.innerHTML = "password must be at least 7 characters long";
            }
            else {
                x.innerHTML = "";
            }
        }

        function checkEmail() {
            var e = _("email").value;
            if (e != "") {
                _("emailstatus").innerHTML = 'checking ...';
                var ajax = ajaxObj("POST", "signup.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        _("emailstatus").innerHTML = ajax.responseText;
                    }

                }
                ajax.send("emailcheck=" + e);
            }
        }


        function signup() {
            var fn = _("firstname").value;
            var ln = _("lastname").value;
            var pn = _("phonenumber").value;
            var e = _("email").value;
            var r = _("roll").value
            var rm = _("room").value;
            var p1 = _("pass1").value;
            var p2 = _("pass2").value;
            var c = "";
            if (document.getElementById('test1').checked) {
                 c = document.getElementById('test1').value;
            }
            else if (document.getElementById('test2').checked) {
                 c = document.getElementById('test2').value;
            }
            else{
                c = "";
            }
            var status = _("status").value;
            if (e == "" || p1 == "" || p2 == "" || fn == "" || ln == "" || pn == "" || r=="" || rm == "" || c =="") {
                _("status").innerHTML = "Please fill out all of the form data";
            }
            else if (p1 != p2) {
                _("status").innerHTML = "Your password fields do not match";
            }
            else {
                // all ok
                _("submit").style.display = "none";
                _("status").innerHTML = "please wait";
                var ajax = ajaxObj("POST", "signup.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        if (ajax.responseText != "signup_success") {
                            _("status").innerHTML = ajax.responseText;
                            _("submit").style.display = "block";
							window.location="index.php";
                        }
                        else {
                            _("status").innerHTML = "Ok.. please check ur inbox for the link";
                            _("submit").style.display = "none";
							window.location="index.php";
                        }
                    }
                }
                ajax.send("fn=" + fn + "&ln=" + ln + "&pn=" + pn + "&e=" + e + "&p=" + p1 + "&r=" + r + "&rm=" + rm + "&c=" + c);
            }

        }
    </script>

</head>
<body>
<form name="sign up for beta form" onsubmit="return false;">
    <div class="header">
        <p>Sign Up For Beta</p>
    </div>
    <div class="description">
        <p>Our form is almost ready. If you're interested in testing it out, then sign up below to get exclusive
            access.</p>
    </div>
    <div class="input">
        <input type="text" class="button" id="firstname" onkeyup="restrict('firstname')" maxlength="88" name="firstname"
               placeholder="ENTER FIRST NAME HERE">
    </div>
    <div class="input">
        <input type="text" class="button" id="lastname" onkeyup="restrict('lastname')" maxlength="88" name="lastname"
               placeholder="ENTER LAST NAME HERE">
    </div>
    <div class="input">
        <input type="text" class="button" id="phonenumber"
               onkeyup="restrict('phonenumber')" onblur="validate_number_length()" maxlength="10" name="email"
               placeholder="ENTER 10 DIGIT MOBILE NUMBER">
    </div>
    <div id="phone_length_status"></div>
    <div class="input">
        <input type="text" class="button" id="email" onfocus="emptyElement('emailstatus')" onblur="checkEmail()"
               onkeyup="restrict('email')" maxlength="88" name="email" placeholder="NAME@EXAMPLE.COM">
    </div>
    <div id="emailstatus"></div>
    <div class="input">
        <input type="text" class="button" id="roll" onfocus="emptyElement('rollstatus')"
               onkeyup="restrict('roll')" maxlength="88" name="email" placeholder="ENTER ROLL NO">
    </div>
    <div id="rollstatus"></div>
    <div class="input">
        <input type="text" class="button" id="room" onfocus="emptyElement('roomstatus')"
               onkeyup="restrict('room')" onblur="validate_room_length()" maxlength="88" name="email" placeholder="ENTER ROOM NO">
    </div>
    <div id="roomstatus"></div>

    <div class="input">
        <input type="password" class="button" id="pass1" onfocus="emptyElement('status')" onblur="validate_length()"
               name="password" placeholder="ENTER YOUR PASSWORD">
    </div>
    <div id="length_status"></div>
    <div class="input">
        <input type="password" class="button" id="pass2" onfocus="emptyElement('status')" name="password"
               placeholder="CONFIRM YOUR PASSWORD">
    </div>
    <br>
    <p>
        <input name="choice" type="radio" id="test1" checked value="1"/>
        <label for="test1"><span style="color:#eeffde; font-size: 17px; font-weight: 600;font-family: Ubuntu,sans-serif">Veg</label>
    </p>
    <p>
        <input name="choice" type="radio" id="test2" value="2"/>
        <label for="test2"><span style="color:#eeffde; font-size: 17px; font-weight: 600; font-family: Ubuntu,sans-serif">NonVeg</span></label>
    </p>

    <div id="submit" onclick="signup()">REGISTER</div>
    <div id="status"></div>


</form>
<script src="js/jquery.min.js"></script>
</body>
</html>