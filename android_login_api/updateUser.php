<?php
ini_set('display_errors','off');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if(isset($_POST['unique_id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_FILES['image']) && isset($_POST['mobnumber'])){

	$unique_id	=	$_POST['unique_id'];

	/*$name 		=	$_POST['name'];
	$email		=	$_POST['email'];
	$ProfilePic = 	$_POST['ProfilePic'];
	$mobnumber	=	$_POST['mobnumber'];*/

	$user = $db->updateUser($unique_id);

	/*if($user != FALSE){

		$response['error'] = FALSE;
		$response['msg']   = "Data has been updated Successfully!";

		echo json_encode($response);
	}else{

        $response["error"] = TRUE;
        $response["error_msg"] = "Please try again!";
        echo json_encode($response);		
	}*/
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode($response);
}

?>

