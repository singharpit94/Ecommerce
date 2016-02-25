<?php
require_once("../resources/config.php");
function redirect_to($url)
{
    header('Location: '.$url);
}
?>
<?php

function logs($str){
    $myfile = fopen("log.txt", "a") or die("Unable to open file!");
    $txt = date("[D M j G:i:s T Y]\n");
    fwrite($myfile, $txt);
    fwrite($myfile, "$str\n\n");
    fclose($myfile);
}
?>
<?php
if (isset($_SESSION["first_name"])) {
    header("location: user.php?u=" . $_SESSION["first_name"]);
    exit();
}
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if (isset($_POST["e"])) {
    $e = escape_string($_POST['e']);
    $p = md5($_POST['p']);
    if ($e == "" || $p == "") {
        echo "login_failed";
        exit();
    } else {
        $query = query("SELECT * FROM users_registered WHERE email='$e' AND activated='1' LIMIT 1");
        confirm($query);
        $user_check = mysqli_num_rows($query);
        $row = fetch_array($query);
        $user_id = $row['id'];
        $user_first_name = $row['first_name'];
        $user_last_name = $row['last_name'];
        $user_email = $row['email'];
        $user_type = $row['type'];
        $user_password = $row['password'];
        $user_roll = $row['roll_no'];
        $user_room = $row['room_no'];
        $user_phone = $row['phone_no'];
        $food = $row['food']*10 +$row['food'];
        if ($p != $user_password) {
            echo "login_failed";
            exit();
        } else {
            $_SESSION['user_id'] = $user_id;
            $_SESSION["fname"] = $user_first_name;
            $_SESSION["lname"] = $user_last_name;
            $_SESSION['email'] = $user_email;
            $_SESSION['type'] = $user_type;
            $_SESSION["room"] = $user_room;
            $_SESSION['roll'] = $user_roll;
            $_SESSION['phone'] = $user_phone;

            //echo $user_first_name;
            $sql = "SELECT * FROM month";
            $query = query($sql);
            confirm($query);
            $row = fetch_array($query);
            $month=$row["id"];
            echo $month;
            $sql = "SELECT * FROM fillup WHERE email='$user_email';";
            $query = query($sql);
            //echo $month;
            confirm($query);
            $check = mysqli_num_rows($query);
            if($check == 0)
            {
                // 1st time user insert
                $sql = "INSERT INTO fillup (email, day1, day2, day3, day4, day5, day6, day7, day8, day9, day10, day11, day12, day13, day14, day15, day16, day17, day18, day19, day20, day21, day22, day23, day24, day25, day26, day27, day28, day29, day30, day31, month) VALUES ('$user_email', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food', '$food','$month');";
                $query = query($sql);
                confirm($query);
                redirect_to("index.php");

                exit();
            }
            else
            {
                echo "not inserted";
                redirect_to("index.php");
                exit();
            }


            exit();

        }


    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/try_form_login.css">
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script>
        function emptyElement(x) {
            _(x).innerHTML = "";
        }

        function login() {
            var e = _("email").value;
            var p = _("pass1").value;
            if (e == "" || p == "") {
                _("status").innerHTML = "Plz fill out the form data";
            }
            else {
                _("submit").style.display = "none";
                _("submit2").style.display = "none";
                _("status").innerHTML = "plz wait...";
                var ajax = ajaxObj("POST", "login.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        console.log(ajax.responseText);


                        if (ajax.responseText.trim() == "login_failed") {
                            _("status").innerHTML = "Login Unsuccessful.. Please try again";
                            _("submit").style.display = "block";
                            _("submit2").style.display = "block";

                        }
                        else {

                            window.location = "index.php";
                            console.log(ajax.responseText);
                        }



                    }
                }
                ajax.send("e=" + e + "&p=" + p);
            }
        }
    </script>
</head>
<body>
<form name="sign up for beta form" onsubmit="return false;">
    <div class="header">
        <p>Log In to enter</p>
    </div>
    <div class="description">
        <p>Log in with your email id and password</p>
    </div>
    <div class="input">
        <input type="text" class="button" id="email" onfocus="emptyElement('status')" maxlength="88" name="email"
               placeholder="NAME@EXAMPLE.COM">
    </div>
    <div class="input">
        <input type="password" class="button" id="pass1" onfocus="emptyElement('status')" name="password"
               placeholder="ENTER YOUR PASSWORD">
    </div>
    <div id="submit" onclick="login()">Log In</div>
    <div id="submit2"><a href="signup.php">New User? Sign Up Here</a></div>
    <div id="status"></div>
    <br>
    <div id="forgot"><a href="forgot_pass.php"><span style="color: #122b40;font-family: "Roboto", sans-serif">Forgot Password?</span></a></div>
</form>
</body>
</html>
