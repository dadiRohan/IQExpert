<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

#API access key from Google API's Console
	define('API_ACCESS_KEY','AAAA5-0upOA:APA91bEru3HqN2ulR0glHqawd5WiMWkp7gIciIO3xqf9jTdGMGLRvZ5CNQ834xq7hcElSgv85QsBVrfxI_kr49pTCZ1yoGvlDFctdvrUAfpFYxHdISRxDM0kWFfMrx3eLMp8PZK-5yy1');


if($getDeviceID = $db->getDeviceID()){

	$count = count($getDeviceID);
	// echo $count;

	foreach ($getDeviceID as $key => $value) {

		$registrationIds	=	$value['device_id'];

	#prep the bundle
     $msg = array
          (
			'body' 	=> '0',
			'title'	=> 'IQ Notification',
           	'isSilent' => FALSE
          );
    
	$fields = array
			(
				'to'		=> $registrationIds, //array($registrationIds) For Multiple Devices
				// 'notification'	=> $msg
				'data' => $msg
			);
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);

#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

#Echo Result Of FireBase Server
echo $result;

	}

}
