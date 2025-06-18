<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

// if (isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['mobnumber'])) {

if (isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['mobnumber']) && isset($_REQUEST['uuid']) && isset($_REQUEST['device_type']) && isset($_REQUEST['device_id'])) {
    // receiving the post params
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];

    //NEW CODE FOR VALID EMAIL
    $explodeAddr = explode('@',$email);

    // echo '<br>'.$explodeAddr[1];

    $verified = array(
        0 => 'gmail.com',
        1 => 'yahoo.com',
        2 => 'yahoo.in',
        3 => 'rediffmail.com'
    );

   if(in_array($explodeAddr[1], $verified)){


    $password = $_REQUEST['password'];
    $mobnumber = $_REQUEST['mobnumber'];

    //NEW PARAMETER for DEVICE
    $uu_id = $_REQUEST['uuid'];
    $device_type = $_REQUEST['device_type'];
    $device_id = $_REQUEST['device_id'];

    // check if user is already existed with the same email
    if ($db->isUserExisted($email)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $email;
        echo json_encode($response);
    } else {
        // create a new user

        //$user = $db->storeUser($name, $email, $password, $mobnumber);
        // With Device Data

        //name, email, password, mobile, uid, uuid, created_at 
        $user = $db->storeUser($name, $email, $password, $mobnumber, $uu_id, $device_type, $device_id);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];

            $response["user"]["password"] = $user["encrypted_password"];

            $response["user"]["mobnumber"] = $user["mobnumber"];
            $response["user"]["created_at"] = $user["created_at"];
            
            
            //FOR DEVICE DATA
            $response["user"]["uuid"] = $user["uuid"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }

  }else{
          $response["error"] = TRUE;
            $response["error_msg"] = "Please Enter Valid & Registered Email Address!";
            echo json_encode($response);
  }  
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email , mobile number or password, uuid, Device Type, Device ID) is missing!";
    echo json_encode($response);
}
?>

