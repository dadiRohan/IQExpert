<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if(isset($_REQUEST['SlotNumber'])){

	$SlotNumber = $_REQUEST['SlotNumber'];
	// echo $SlotNumber;

	if($bid = $db->getbidUsersDetails($SlotNumber)){

		// echo 'GET ALL';
		// $response['error'] = FALSE;
		$response = $bid;
		echo json_encode($response);
	}else{

		// echo 'Didn`t get All';
		$response["error"] = TRUE;
	    $response["error_msg"] = "User`s not available!";
	    echo json_encode($response);	
	}
}else{

	$response["error"] = TRUE;
	$response["error_msg"] = "Required Parameters are missing!";
    echo json_encode($response);	
}

?>