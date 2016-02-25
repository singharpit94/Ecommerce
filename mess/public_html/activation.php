<?php
require_once("../resources/config.php");

//gets called when user clicks on the email link u send them

if (isset($_GET['id']) && isset($_GET['e']) && isset($_GET['p'])) {

    //sanitize the variables
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']);
    $e = escape_string($_GET['e']);
    $p = escape_string($_GET['p']);
    // Evaluate the lengths of the incoming $_GET variable
    if ($id == "" || strlen($e) < 3 || strlen($p) == "") {
        // Log this issue into a text file and email details to yourself
        header("location: message.php?msg=activation_string_length_issues");
        exit();
    }
    // Check their credentials against the database
    $sql = "SELECT * FROM users_registered WHERE id='$id' AND email='$e' AND password='$p' LIMIT 1";
    $query = query($sql);
    confirm($query);
    $numrows = mysqli_num_rows($query);
    if ($numrows == 0) {
        header("location: message.php?msg=Your credentials are not matching anything in our system");
        exit();
    }
    //match was found .. Activate user
    $sql = "UPDATE users_registered SET activated='1' WHERE id='$id' LIMIT 1";
    $query = query($sql);
    //optional double check for activated field in our database
    $sql = "SELECT * FROM users_registered WHERE id='$id' AND activated='1' LIMIT 1";
    $query = query($sql);
    confirm($query);
    $numrows = mysqli_num_rows($query);
    if ($numrows == 0) {
        header("location: message.php?msg=activation_failure");
        exit();
    } else if ($numrows == 1) {
        header("location: message.php?msg=activation_success");
        exit();
    }

} else {
    //missing GET variables
    header("location: message.php?msg=missing_GET_variables");
    exit();

}
?>