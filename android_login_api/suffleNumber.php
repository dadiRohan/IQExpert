<?php
error_reporting('E_ALL');
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

/*echo 'Static No: '.$random_no = '859736';
echo rand($random_no - 100, $random_no + 100);*/

if(isset($_REQUEST['SlotNumber']) && isset($_REQUEST['randValue'])){

	$SlotNumber = $_REQUEST['SlotNumber'];
	$randValue  = $_REQUEST['randValue'];

	$newrandValue = rand($randValue - 100, $randValue + 100);

	if($Slot = $db->generateNewRandom($SlotNumber,$randValue,$newrandValue)){

		$response['error'] = FALSE;
		$response['suffle']['SlotNumber'] = $Slot['playSlot']/*$SlotNumber*/;
		$response['suffle']['randValue']  = $Slot['randValue']/*$randValue*/;
		$response['suffle']['newrandValue'] = $Slot['new_randValue']/*$newrandValue*/;

		echo json_encode($response);
		// echo json_encode($Slot);
	}else{

		$response['error'] = TRUE;
		$response['msg'] = 'Does not Get Value';

		echo json_encode($response);
	}
}else{

	$response['error'] = TRUE;
	$response['msg'] = 'Parameters are missing';
	echo json_encode($response);
}


?>