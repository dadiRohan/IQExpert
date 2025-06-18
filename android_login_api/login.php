<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['DeviceID'])) {

    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];
    $DeviceID = $_POST['DeviceID'];

    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($email, $password, $DeviceID);

    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
        $response["uid"] = $user["unique_id"];
        $response["user"]["name"] = $user["name"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["mobnumber"] = $user["mobnumber"];
        $response["user"]["created_at"] = $user["created_at"];
        $response["user"]["uuid"] = $user["uuid"];

        /*
        USER Able To login By using Device ID means he will can't access his account to other Device
        Then Need to verify from his device by using Device ID
        */
        // $response["user"]["device_id"] = $user["device_id"];
        
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>

