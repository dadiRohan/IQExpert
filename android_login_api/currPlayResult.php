<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if(isset($_REQUEST['SlotID']) && isset($_REQUEST['SlotNumber'])){

	$SlotID 	=	$_REQUEST['SlotID'];
	$SlotNumber = 	$_REQUEST['SlotNumber'];

	if($currPlayResult = $db->currPlayResult($SlotID,$SlotNumber)){

		// echo 'GET ALL';
		$response['error'] = FALSE;
		$response['currPlayResult'] = $currPlayResult;

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