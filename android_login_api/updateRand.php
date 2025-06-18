<?php
ini_set('display_errors','on');

date_default_timezone_set('Asia/Calcutta');


require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$update = $db->updateRand();

if($update>0){

	$response["error"] = FALSE;
	$response["msg"]   = "Status Updated !";

	echo json_encode(array($response));
}else{

	$response["error"] = TRUE;
	$response["msg"]   = "Status Doesn't  Updated !";

	echo json_encode(array($response));
}

?>