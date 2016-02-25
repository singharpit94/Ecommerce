<?php
require_once("../resources/config.php");
function redirect_to($url)
{
    header('Location: ' . $url);
}

if (isset($_SESSION['email'])) {
    redirect_to("index.php");
}
?>
<?php
//email check for forgot pass

if (isset($_POST["emailcheck"])) {
    $email = escape_string($_POST['emailcheck']);
    $query = query("SELECT * FROM users_registered WHERE email='$email' LIMIT 1");
    confirm($query);
    $email_check = mysqli_num_rows($query);

    if ($email_check < 1) {
        echo $email . ' is not in our database';
        exit();

    } else if ($email_check == 1) {
        echo '<span style="color: #006400">' . $email . ' is Ok</span>';
        exit();
    }
}
?>

<?php
//Ajax calls this to execute
if (isset($_POST["e"])) {
    $e = escape_string($_POST['e']);
    $sql = "SELECT * FROM users_registered WHERE email='$e' AND activated='1' LIMIT 1";
    $query = query($sql);
    confirm($query);
    $numrows = mysqli_num_rows($query);
    if ($numrows > 0) {
        $row = fetch_array($query);
        $user_email = $row['email'];
        $user_first_name = $row['first_name'];

        $emailcut = substr($e, 0, 4);
        $randNum = rand(10000, 99999);
        $tempPass = "$emailcut$randNum";
        $hashTempPass = md5($tempPass);
        $to = "$user_email";
        $from = "hall2mess";
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $subject = "yoursite Temporary Password";
        $msg = '<h2>Hello ' . $user_first_name . '</h2><p>This is an automated message from hall2mess.
                If you did not recently initiate the Forgot Password process, please disregard this email.
                </p><p>You indicated that you forgot your login password. We can generate an automatic password
                for you to log in with.
                </p><p>After you click the link below your password to login will be:<br /><b>' . $tempPass . '</b>
                </p><p><a href="forgot_pass.php?fn=' . $user_first_name . '&p=' . $hashTempPass . '&e=' . $user_email . '">
                Click here now to apply the temporary password shown below to your account</a></p><p>
                If you do not click the link in this email, no changes will be made to your account.
                In order to set your login password to the automatic password you must click the link above.</p>';

        if (mail($to, $subject, $msg, $headers)) {
            echo "success";     //echoes to AJAX
            exit();
        } else {
            echo "email_send_failed";   //echoes to AJAX
            exit();
        }

    } else {
        echo "no_exist";
    }
    exit();
}
?>

<?php
// clicks on email link
if (isset($_GET['fn']) && isset($_GET['p']) && isset($_GET['e'])) {
    $fn = $_GET['fn'];
    $e = $_GET['e'];
    $temppasshash = preg_replace('#[^a-z0-9]#i', '', $_GET['p']);
    if (strlen($temppasshash) < 10) {
        exit();
    }
    $sql = "INSERT INTO temporary(first_name,email,password) VALUES ('$fn','$e','$temppasshash');";
    $query = query($sql);
    confirm($query);

    $sql = "SELECT * FROM temporary WHERE first_name='$fn' AND email='$e' AND password='$temppasshash' LIMIT 1";
    $query = query($sql);
    confirm($query);
    $numrows = mysqli_num_rows($query);
    if ($numrows == 0) {
        header("location: message.php?msg=There is no match for that username with that temporary password in the system. We cannot proceed.");
        exit();
    } else {
        $sql = "UPDATE users_registered SET password='$temppasshash' WHERE first_name='$fn' AND email='$e' LIMIT 1";
        $query = query($sql);
        confirm($query);
        header("location: login.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <style type="text/css">
        #forgotpassform {
            margin-top: 24px;
        }

        #forgotpassform > div {
            margin-top: 12px;
        }

        #forgotpassform > input {
            width: 250px;
            padding: 3px;
            background: #F3F9DD;
        }

        #forgotpassbtn {
            font-size: 15px;
            padding: 10px;
        }
    </style>
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
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
                var ajax = ajaxObj("POST", "signup.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        _("emailstatus").innerHTML = ajax.responseText;
                    }

                }
                ajax.send("emailcheck=" + e);
            }
        }

        function forgotpass() {
            var e = _("email").value;
            if (e == "") {
                _("status").innerHTML = "Type in your email address";
            } else {
                _("forgotpassbtn").style.display = "none";
                _("status").innerHTML = 'please wait ...';
                var ajax = ajaxObj("POST", "forgot_pass.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        var response = ajax.responseText;
                        if (response == "success") {
                            _("forgotpassform").innerHTML = '<h3>Step 2. Check your email inbox in a few minutes</h3><p>You can close this window or tab if you like.</p>';
                        } else if (response == "no_exist") {
                            _("status").innerHTML = "Sorry that email address is not in our system";
                        } else if (response == "email_send_failed") {
                            _("status").innerHTML = "Mail function failed to execute";
                        } else {
                            _("status").innerHTML = "An unknown error occurred";
                        }
                    }
                }
                ajax.send("e=" + e);
            }
        }
    </script>

</head>
<body>
<div id="pageMiddle">
    <h3>Generate an automatic log in password</h3>

    <form id="forgotpassform" onsubmit="return false;">
        <div>Step 1: Enter Your Email Address</div>
        <input id="email" type="text" onfocus="emptyElement('status')" onblur="checkEmail()"
               onkeyup="restrict('email')" maxlength="88" maxlength="88">
        <br/><br/>
        <button id="forgotpassbtn" onclick="forgotpass()">Generate Automatic Log In Password</button>
        <p id="status"></p>
    </form>
</div>
</body>
</html>