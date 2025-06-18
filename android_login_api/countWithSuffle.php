<?php
error_reporting('E_ALL');
ini_set('display_errors','on');

//$sec = "5";
header("Refresh: 10");

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

/*echo 'Static No: '.$random_no = '859736';
echo rand($random_no - 100, $random_no + 100);*/

if(isset($_REQUEST['SlotNumber']) && isset($_REQUEST['randValue'])){

	$SlotNumber = $_REQUEST['SlotNumber'];
	$randValue  = $_REQUEST['randValue'];

	$newrandValue = rand($randValue - 100, $randValue + 100);

	if($Slot = $db->generateNewRandom($SlotNumber,$randValue,$newrandValue)){

		if($countSlotusers = $db->countbidUsers($SlotNumber)){

			// echo 'GET ALL';
			$response['error'] = FALSE;
			$response['bid']['countUser'] = $countSlotusers;
			$response['bid']['SlotNumber'] = $SlotNumber;
			$response['bid']['randValue']  = $randValue;
			$response['bid']['newrandValue'] = $newrandValue;

			echo json_encode($response);
		}else{

			$response['error'] = TRUE;
			$response['msg'] = 'Counting not getting because no player Bidded';

			echo json_encode($response);
		}
	}else{

		$response['error'] = TRUE;
		$response['msg'] = 'Parameters are missing';

		echo json_encode($response);
	}
}else{

	$response['error'] = TRUE;
	$response['msg'] = 'Parameters are missing';
	echo json_encode($response);
}


?>