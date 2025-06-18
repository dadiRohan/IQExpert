<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

date_default_timezone_set('Asia/Calcutta');

$dateTime = date('Y-m-d H:i:s');

echo json_encode(
	array(
		'dateTime' => $dateTime
	)
);

?>