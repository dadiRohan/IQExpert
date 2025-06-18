<?php
ini_set('display_errors','on');
date_default_timezone_set('Asia/Calcutta');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

header('Content-type: application/json');
/*{
    "time":"18"
}*/
/*$val = $_REQUEST;

print_r($val);*/
// echo json_decode($val);

// echo $time = $_REQUEST['time'];
	
if(isset($_REQUEST['time'])){

	$time 		=	$_REQUEST['time'];
	$time       =   (string)$time;

	if($searchSlotID = $db->searchSlotID($time)){

		$response = $searchSlotID;
		echo json_encode($response);
	}else{

		// echo 'Didn`t get All';
		$response["error"] = TRUE;
	    $response["error_msg"] = "Search data not available !";

	    echo json_encode($response);	
	}
}else{

	$response["error"] = TRUE;
	$response["error_msg"] = "Required Parameters are missing!";

    echo json_encode($response);	
}

?>