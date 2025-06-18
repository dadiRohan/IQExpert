<?php
ini_set('display_errors','on');

//test
date_default_timezone_set('Asia/Calcutta'); 
/*echo '$startTime:'.$startTime = date("H:i",time() - 1800);
echo '$endTime:'.$endTime = date("H:i",time() + 1800);*/

// $thestime = '2012-07-27 20:40';
/*$thestime = date("H:i");
$datetime_from = date("H:i",strtotime("-30 minutes",strtotime($thestime)));
echo $datetime_from;
echo '<br><br>';*/
//test

// header("Refresh: 5; url=getRand.php");

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$row = $db->getRand();

$update = $db->updateRand();


// $response = array("error" => FALSE);

$response = array();

if($row){


	/*echo '<pre>';
	print_r($row);
	echo '</pre>';*/

	/*for($i = 0; $i < count($row); $i++){

		$response['playSlot'] =  $row[$i]['playSlot'];
		$response['randValue'] =  $row[$i]['randValue'];
		$response['time'] =  $row[$i]['time'];
		$response['status'] =  $row[$i]['status'];
		
		if($row[$i]['status'] != 'inactive'){
			echo json_encode(array($row[$i]));
		}else{
		}
	}*/


	// echo '<br><br>';
	//Directly fetch and display
	$time = date('H:').'00';
	$nxt  = date('H:').'45';
	if($time < $nxt){

		echo json_encode($row);
	}else{

		$response['error'] = FALSE;
		$response['msg'] = 'GAME has been started';
		echo json_encode($response);
	}
}else{

	$response["error"] = TRUE;
	$response["msg"]   = "Data does not get !";

	echo json_encode(array($response));
}

?>