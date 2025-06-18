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

if(isset($_REQUEST['uid']) && isset($_REQUEST['bankUUID']) && isset($_REQUEST['bankName']) && isset($_REQUEST['accHolderName']) && isset($_REQUEST['bankBranch']) && isset($_REQUEST['AccNo']) && isset($_REQUEST['IFSC'])){


	$uid 			=	$_REQUEST['uid'];
	$bankUUID		=	$_REQUEST['bankUUID'];
	$bankName		=	$_REQUEST['bankName'];
	$accHolderName	=	$_REQUEST['accHolderName'];
	$bankBranch		=	$_REQUEST['bankBranch'];
	$AccNo			=	$_REQUEST['AccNo'];
	$IFSC 			=	$_REQUEST['IFSC'];
    /*if($_REQUEST['cardType'] == "MASTERCARD"){
		$cardType		= 	"http://iqexpert.in/android_login_api/card/ic_mastercard.png";
	}else if($_REQUEST['cardType'] == "VISA"){
		$cardType		= 	"http://iqexpert.in/android_login_api/card/ic_visa.png";
	}*/ 
       

    //FOR WALLET
	// $wallet = $db->generateWallet($uid);

	if($bank = $db->addUserBank($uid,$bankUUID,$bankName,$accHolderName,$bankBranch,$AccNo,$IFSC)){

		// echo 'Valid';
        $response['error'] = FALSE;
		$response['bank']['uid'] = $uid;
		$response['bank']['bankUUID'] = $bankUUID;
        $response['bank']['bankName'] = $bankName;
        $response['bank']['accHolderName'] = $accHolderName;
        $response['bank']['bankBranch'] = $bankBranch;
        $response['bank']['AccNo'] = $AccNo;
        $response['bank']['IFSC'] = $IFSC;

        echo json_encode($response);
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