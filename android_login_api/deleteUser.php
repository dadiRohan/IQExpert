<?php
ini_set('display_errors','on');

date_default_timezone_set('Asia/Calcutta');


require_once 'include/DB_Functions.php';
$db = new DB_Functions();

if($_POST['unique_id']){
	
	$update = $db->deleteUser($_POST['unique_id']);

	if($update>0){

		$response["error"] = FALSE;
		$response["msg"]   = "Status Disabled !";

		echo json_encode(array($response));
	}else{

		$response["error"] = TRUE;
		$response["msg"]   = "Status Doesn't  Disabled !";

		echo json_encode(array($response));
	}	
}else{
		$response["error"] = FALSE;
		$response["msg"]   = "ERROR !";

		echo json_encode(array($response));
}



?>