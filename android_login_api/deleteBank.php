<?php
ini_set('display_errors','on');

/*
NEW PARAMETERS:

Bank Name
Account Holder Name
Bank Branch
Account Number
IFSC Code
*/
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if(isset($_REQUEST['uid']) && isset($_REQUEST['bankUUID'])){

	$uid 			=	$_REQUEST['uid'];
	$bankUUID		=	$_REQUEST['bankUUID'];

	if($bank = $db->deleteBank($uid,$bankUUID)){

		if($count = $db->countBank($uid)){
			// echo 'Valid';
	        $response['error'] = FALSE;
			$response['bank']['uid'] = $uid;
	        $response['bank']['bankUUID'] = $bankUUID;
	        $response['bank']['count'] = $count;
	        $response['bank']['status'] = 'Bank Deleted Successfully!';
	        echo json_encode($response);
		}else{
			// echo 'Valid';
	        $response['error'] = FALSE;
			$response['bank']['uid'] = $uid;
	        $response['bank']['bankUUID'] = $bankUUID;
	        $response['bank']['count'] = 0;
	        $response['bank']['status'] = 'Bank Deleted Successfully!';
	        echo json_encode($response);			
		}
	}else{

		// echo ' NOT BANK';
	}
}else{

    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode($response);
}

?>