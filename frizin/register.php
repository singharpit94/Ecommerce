<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['fullname']) && isset($_POST['address'])) 
{
 
    // receiving the post params
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
 
    // check if user is already existed with the same username
    if ($db->isUserExisted($username)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $username;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->storeUser($username, $email, $password,$phone,$fullname,$address);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["username"] = $user["username"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["phone"] = $user["phone"];
	    $response["user"]["address"] = $user["address"];
            $response["user"]["fullname"] = $user["fullname"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}
?>
