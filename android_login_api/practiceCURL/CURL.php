<?php
/*session_start();

echo 'WELCOME '.$_SESSION['user'];*/

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'cURLFunction.php';

//$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/getHistoryPlay.php';
/*$request = array(
    "UID" => "5b16384f4b8504.39394722",
    "indexID" => "1"
);*/
$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/counter.php';
$request = array();

$curlObj = new CURL;
$response = $curlObj->getjsondata($url,$request);

echo $response;
echo '<br><br>';
$result = json_decode($response,true);
// print_r($result);

// echo $result;
$forResult = $result['count'];

echo $currentRegisterUsers =  $result['count']['currentRegisterUsers'];

echo $currentbidAllUsers   =  $result['count']['currentbidAllUsers'];

echo $currentbidHighUsers  =  $result['count']['currentbidHighUsers'];

echo $currentbidLowUsers   =   $result['count']['currentbidLowUsers'];

foreach ($forResult as $key => $value) {
    /*foreach ($value as $key => $data) {
        echo $key;
        print_r($value[$key]);
        // echo '<b>'.$data.'</b>';
        echo '<br><br>';
    }*/
}


?>