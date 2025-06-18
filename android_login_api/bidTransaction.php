<?php
date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

/*
I have to check status before entring in database because without final status player can`t be able to play the game so first need to check status then its better to ensure the transaction has been done or not
But we have to wait for Instamojo status then we will implement in code
*/
// if($_REQUEST['status'] == "Success"){

if(isset($_REQUEST['SlotID']) && isset($_REQUEST['SlotNumber']) && isset($_REQUEST['randValue']) && isset($_REQUEST['bid']) && isset($_REQUEST['amount']) && isset($_REQUEST['status']) && isset($_REQUEST['orderId']) && isset($_REQUEST['paymentId']) && isset($_REQUEST['token']) && isset($_REQUEST['UID']) && isset($_REQUEST['email']) && isset($_REQUEST['mobnumber'])){

	$SlotID			=	$_REQUEST['SlotID'];
	$SlotNumber 	=	$_REQUEST['SlotNumber'];
	$randValue		=	$_REQUEST['randValue'];
	$bid 			=	$_REQUEST['bid'];
	$amount			=	$_REQUEST['amount'];
	$status			=	$_REQUEST['status'];
	$orderId 		=	$_REQUEST['orderId'];
	$paymentId 		=	$_REQUEST['paymentId'];
	$token 			=	$_REQUEST['token'];
	$UID 			=	$_REQUEST['UID'];
	$email			=	$_REQUEST['email'];
	$mobnumber 		=	$_REQUEST['mobnumber'];

	$Time 			=	date('H').':40';

	if($inset = $db->bidTransaction($SlotID,$SlotNumber,$randValue,$bid,$amount,$status,$orderId,$paymentId,$token,$UID,$email,$mobnumber)){

		$response['error'] = FALSE;
		
		$response['bid']['SlotNumber'] = $SlotNumber;
		$response['bid']['SlotID'] = $SlotID;
		$response['bid']['randValue'] = $randValue;
		$response['bid']['bidStatus'] = $bid;
		$response['bid']['status'] = $status;
		$response['bid']['amount'] = $amount;
		$response['bid']['UID'] = $UID;
		$response['bid']['time'] = $Time;

		echo json_encode($response);
	}else{

	    $response["error"] = TRUE;
	    $response["error_msg"] = "Data Doesn't added Please Try Again!";
	    echo json_encode($response);	
	}
}else{

    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode($response);
}

// }
?>