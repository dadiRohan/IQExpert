<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if(isset($_REQUEST['uid'])){

	$uid 						=	$_REQUEST['uid'];
	
	if($bank = $db->PayUWallet($uid)){

		// echo 'Valid';
		$response['error']						= FALSE;
        $response['wallet']						= $bank;
 
        echo json_encode($response);
	}else{
		$response['error']						= FALSE;
		$response['wallet']						= array('uid'=>$uid,'amount'=>0);
        echo json_encode($response);
	}
}else{

    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters are missing!";
    echo json_encode($response);
}

?>