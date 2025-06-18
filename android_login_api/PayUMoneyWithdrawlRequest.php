<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if(isset($_REQUEST['uid']) && isset($_REQUEST['FullName']) && isset($_REQUEST['BankName']) && isset($_REQUEST['AccountID']) && isset($_REQUEST['IFSC']) && isset($_REQUEST['type']) && isset($_REQUEST['withdrawalAmount'])){


	$uid 						=	$_REQUEST['uid'];
	$FullName					=	$_REQUEST['FullName'];
	$BankName					=	$_REQUEST['BankName'];
	$AccountID					=	$_REQUEST['AccountID'];
	$IFSC						=	$_REQUEST['IFSC'];
	$type 						=	$_REQUEST['type'];
	$withdrawalAmount			=	$_REQUEST['withdrawalAmount'];
	
	if($bank = $db->PayUMoneyWithDrawl($uid,$FullName,$BankName,$AccountID,$IFSC,$type,$withdrawalAmount)){

		// echo 'Valid';
		$response['error']						= FALSE;
		$response['bank']['uid'] 				= $uid;
        $response['bank']['FullName'] 			= $FullName;
        $response['bank']['BankName'] 			= $BankName;
        $response['bank']['AccountID'] 			= $AccountID;
        $response['bank']['IFSC'] 				= $IFSC;
        $response['bank']['type'] 				= $type;
        $response['bank']['withdrawalAmount'] 	= $withdrawalAmount;
        //Wallet
        $response['bank']['WalletAmount'] 		= $bank;
        $response['bank']['msg']				= 'Data Entered!';

        echo json_encode($response);
	}else{

		// echo ' NOT BANK';
				// echo 'Valid';
		$response['error']						= FALSE;
		$response['bank']['uid'] 				= $uid;
        $response['bank']['FullName'] 			= $FullName;
        $response['bank']['BankName'] 			= $BankName;
        $response['bank']['AccountID'] 			= $AccountID;
        $response['bank']['IFSC'] 				= $IFSC;
        $response['bank']['type'] 				= $type;
        $response['bank']['withdrawalAmount'] 	= $withdrawalAmount;
        //Wallet
        $response['bank']['WalletAmount'] 		= 0;
        $response['bank']['msg']				= 'Data Entered!';

        echo json_encode($response);
	}
}else{

    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode($response);
}

?>