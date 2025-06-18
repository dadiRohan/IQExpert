<?php
error_reporting('E_ALL');
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

date_default_timezone_set('Asia/Calcutta');

if(isset($_REQUEST['SlotNumber'])){

	$SlotNumber = $_REQUEST['SlotNumber'];

	if($Slot = $db->updatedNewRandom($SlotNumber)){

		if($countSlotusers = $db->countbidUsers($SlotNumber))	

		$response['error'] = FALSE;
		$response['suffle']['SlotNumber'] = $Slot['playSlot'];
		$response['suffle']['randValue']  = $Slot['randValue'];
		$response['suffle']['newrandValue'] = $Slot['new_randValue'];
		$response['suffle']['countUsers'] = $countSlotusers;

		$time = 55;
		$second = date('i');
		
		if($time > $second){
		$response['suffle']['status'] = FALSE;
		}else{
		$response['suffle']['status'] = TRUE;
		}

		echo json_encode($response);
		// echo json_encode($Slot);
	}else{

		$response['error'] = TRUE;
		$response['msg'] = 'Does not Get Value';

		echo json_encode($response);
	}
}else{

	$response['error'] = TRUE;
	$response['msg'] = 'Parameters are missing ';
	echo json_encode($response);
}

?>