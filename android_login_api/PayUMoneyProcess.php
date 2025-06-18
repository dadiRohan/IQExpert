<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

//Process Start

// $data = $_REQUEST['transactionProcessData'];

// $_REQUEST['transactionProcessData'] = '[{"SlotNumber":"200","SlotID":"C","randValue":"377110","bidStatus":"low","amount":"5","bidProLoss":"-3","finalAmount":"2","UID":"5b16384f4b8504.39394722"}]';

$data = $_REQUEST['transactionProcessData'];

$jsonDecode = json_decode($data,'true');

// echo $count = count($jsonDecode);

foreach ($jsonDecode as $keyDecode => $valueDecode) {

	$uid = $valueDecode['UID'];
	$Amount = $valueDecode['finalAmount'];
	if($Process = $db->PayUMoneyProcess($uid,$Amount)){

		echo json_encode($Process);
	}else{

		$response['msg'] = 'Does not proceed..?';
		echo json_encode($response);
	}
}

?>