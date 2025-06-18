<?php
ini_set('display_errors','on');
/*
uid,cardNumber,cardValidity,cardCVV,cardName  parameter for bank details upload and return me the same parameter
*/

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

if(isset($_REQUEST['uid']) && isset($_REQUEST['bankUUID']) && isset($_REQUEST['bankName']) && isset($_REQUEST['accHolderName']) && isset($_REQUEST['bankBranch']) && isset($_REQUEST['AccNo']) && isset($_REQUEST['IFSC'])){


	$uid 			=	$_REQUEST['uid'];
	$bankUUID		=	$_REQUEST['bankUUID'];
	$bankName		=	$_REQUEST['bankName'];
	$accHolderName	=	$_REQUEST['accHolderName'];
	$bankBranch		=	$_REQUEST['bankBranch'];
	$AccNo			=	$_REQUEST['AccNo'];
	$IFSC 			=	$_REQUEST['IFSC'];

	// if($upBank = $db->updateUserBank($uid,$cardNumber,$cardValidity,$cardCVV,$cardName)){
	$upBank = $db->updateUserBank($uid,$bankUUID,$bankName,$accHolderName,$bankBranch,$AccNo,$IFSC);
        $response['error'] = FALSE;
		$response['bank']['uid'] = $uid;
		$response['bank']['bankUUID'] = $bankUUID;
        $response['bank']['bankName'] = $bankName;
        $response['bank']['accHolderName'] = $accHolderName;
        $response['bank']['bankBranch'] = $bankBranch;
        $response['bank']['AccNo'] = $AccNo;
        $response['bank']['IFSC'] = $IFSC;
        $response['bank']['status'] = 'Bank Details Updated Successfully !';

        echo json_encode($response);

	/*}else{
		echo 'bb';
	}*/

}else{

    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode($response);
}

?>