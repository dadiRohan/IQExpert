<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if(isset($_REQUEST['UID']) && isset($_REQUEST['indexID'])){

	$UID 	=	$_REQUEST['UID'];
	$indexID = 	$_REQUEST['indexID'];

	if($getHistoryPayment = $db->getHistoryPayment($UID,$indexID)){

		//$response['error'] = FALSE;
		//$response['getHistoryPayment'] = $getHistoryPayment;
		$response = $getHistoryPayment;
		echo json_encode($response);
	}else{

		// echo 'Didn`t get All';
		$response["error"] = TRUE;
	    $response["error_msg"] = "User`s data not available for this index!";

	    echo json_encode($response);	
	}
}else{

	$response["error"] = TRUE;
	$response["error_msg"] = "Required Parameters are missing!";

    echo json_encode($response);
}

?>