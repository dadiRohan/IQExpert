<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'cURLFunction.php';

$url = 'http://localhost:4430/IQE/IqExpertApi/android_login_api/register.php';

if(!empty($_REQUEST['name'])){
    
    $request = array(
        "name" => $_REQUEST['name'],
        "email" => $_REQUEST['email'],
        "password" => $_REQUEST['password'],
        "mobnumber" => $_REQUEST['mobnumber'],
        "uuid" => $_REQUEST['uuid'],
        "device_type" => $_REQUEST['device_type'],
        "device_id" => $_REQUEST['device_id']
    );

    $curlObj = new CURL;
    $response = $curlObj->getjsondata($url,$request);

    echo $response;
}

?>


<h1>Registration</h1>
<form action="" method="post" >
    <input type="text" name="name" placeholder="name" /><br/>
    <input type="email" name="email" placeholder="email" /><br/>
    <input type="password" name="password" placeholder="password" /><br/>
    <input type="number" name="mobnumber" placeholder="number" /><br/>
    <input type="number" name="uuid" placeholder="uuid" /><br/>
    <input type="text" name="device_type" placeholder="device_type" /><br/>
    <input type="text" name="device_id" placeholder="device_id" /><br/>
    <input type="submit" name="submit"/>
</form>