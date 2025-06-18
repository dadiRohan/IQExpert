<?php
ini_set('display_errors','on');
date_default_timezone_set('Asia/Calcutta');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if(isset($_REQUEST['UID']) /*|| isset($_REQUEST['fromDate']) || isset($_REQUEST['toDate'])*/){

	$UID 		=	$_REQUEST['UID'];
        $IndexID        =       $_REQUEST['IndexID']; 
	if(isset($_REQUEST['fromDate'])){

		$fromDate 	= 	$_REQUEST['fromDate'];
	}else{

		$fromDate   =   '0000-00-00';
	}

	if(isset($_REQUEST['toDate'])){

		$toDate 	=	$_REQUEST['toDate'];
	}else{

		$toDate		=	date('Y-m-d');
	}

	if($searchHistoryPayment = $db->searchHistoryPayment($UID,$IndexID,$fromDate,$toDate)){

		// echo 'GET ALL';
		//$response['error'] = FALSE;
		//$response['searchHistoryPayment'] = $searchHistoryPayment;
                $response =  $searchHistoryPayment;
		echo json_encode($response);
	}else{

		// echo 'Didn`t get All';
		//$response["error"] = TRUE;
	    $response["error_msg"] = "Search data not available !";

	    echo json_encode($response);	
	}
}else{

	$response["error"] = TRUE;
	$response["error_msg"] = "Required Parameters are missing!";

    echo json_encode($response);	
}

?>