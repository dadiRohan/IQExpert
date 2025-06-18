<?php
date_default_timezone_set('Asia/Calcutta');
// echo $data = date('Y-m-d H:i:s');
// echo time();
?>
<!DOCTYPE html>
<html>
<head>
	<title>IQEXPERT API</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<style type="text/css">
		.MobileAPI{
			background-color: #EEE8AA;
			width: 100px;
		}
		.WebServices{
			background-color: #00FFFF;
			width: 100px;
		}
		.AdminAPI{
			background-color: #FFCCCC;	
			width: 100px;
		}
		.wordwrap{
			word-wrap: break-word;
		}
	</style>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript"> 
		function display_c(){
			var refresh=10; // Refresh rate in milli seconds
			setTimeout('display_ct()',refresh)
		}

		function display_ct() {
			display_c();
			var x = new Date()
			var x1 =  x.getHours()+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
			document.getElementById('ct').innerHTML = x1;
		}
	</script>
</head>
<body onload=display_ct();>
	<div class="container-fluid">
		<h1 style="font-weight: bold;color: #fff;"><marquee style="background-color: #4682B4;" direction="right" scrolldelay="100"><i> ..:: Welcome To IQExpert ::.. </marquee></i></h1>
		<h3 style="color: #7B68EE;">IQExpert API Documentation 
			(<span id='ct' style="color:#FF1493;"></span>)
		</h3>

		<h4>
			<p>
				<span class="WebServices"><b>IQ-Expert</b></span> Indicates This is Web Services API
			</p>
			<p>
				<span class="MobileAPI"><b>IQ-Expert</b></span> Indicates This is Mobile API
			</p>
			<p>
				<span class="AdminAPI"><b>IQ-Expert</b></span> Indicates This is Admin API
			</p>
		</h4>

		<table class="table table-hover" style="table-layout: fixed; width: 100%">
		  <thead>
		    <tr style="background-color: #228B22;color: #fff;">
		      <th scope="col">#</th>
		      <th scope="col" >API</th>
		      <th scope="col" colspan="2">URL</th>
		      <th scope="col" colspan="3" style="word-wrap: break-word">ATTRIBUTE</th>
		    </tr>
		  </thead>
		  <tbody class="MobileAPI">

		  	<tr class="WebServices">
		      <th scope="row">A</th>
		      <td>Trigger Today 12 Slots</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/putRand.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i)REQUEST :</b>
		      	<br>
		      	NA
		      	<br>
		      	<b>(ii)RESPONSE :</b>
		      	<br>
		      	{"error":false,"0":{"msg":"Data has been inserted Successfully !"}}
		      </td>	
		    </tr>
		    <tr class="WebServices">
		      <th scope="row">B</th>
		      <td>Update Trigger</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/updateRand.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i)REQUEST :</b>
		      	<br>
		      	NA
		      	<br>
		      	<b>(ii)RESPONSE :</b>
		      	<br>
		      	{"error":false,"0":{"msg":"Data has been updated Successfully !"}}	
		      </td>
		    </tr>
		    <tr class="WebServices">
		      <th scope="row">C</th> 
		      <td>Result for Transfer final price</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/resultBidDetails.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"SlotNumber":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"SlotNumber":"200","SlotID":"C","randValue":"377110","bidStatus":"low","amount":"5","bidProLoss":"-3","finalAmount":"2","UID":"5b16384f4b8504.39394722"},{"SlotNumber":"200","SlotID":"C","randValue":"377110","bidStatus":"high","amount":"80","bidProLoss":"2","finalAmount":"82","UID":"5b16384f4b8504.39394722"}]
		      </td>
		    </tr>
		    <tr class="WebServices">
		      <th scope="row">D</th>
		      <td> Search SlotID For Desktop Application</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/searchSlotID.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {'time'}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"play_slot_id":"9","playSlot":"H","date":"2018-08-20","time":"17:00","randValue":"605323","new_randValue":"","createdDate":"2018-08-20 17:32:04","updatedDate":"2018-08-20 17:32:04","status":"active"}
		      </td>
		    </tr>
		    <tr class="WebServices">
		      <th scope="row">E</th>
		      <td>Current Slot Auto Random Generated</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/suffleNumber.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"SlotNumber":"","randValue":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"suffle":{"SlotNumber":"I","randValue":"548428","newrandValue":548407}}
		      </td>
		    </tr>
		    <tr class="WebServices">
		      <th scope="row">F</th>
		      <td>PayUMoney Process For <b>Bulk Entries JSON DATA</b></td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/PayUMoneyProcess.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {'transactionProcessData'}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"unique_id":"5b16384f4b8504.39394722","totalAmount":"895"}][{"unique_id":"5b16384f4b8504.39394722","totalAmount":"814"}][{"unique_id":"5b16384f4b8504.393947221","totalAmount":"81"}]
		      </td>
		    </tr>
		    <tr class="WebServices">
		      <th scope="row">G</th>
		      <td>Push Notification FCM Trigger</b></td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/simpleFCM.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 NA
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"multicast_id":8732899217772905480,"success":1,"failure":0,"canonical_ids":0,"results":[{"message_id":"0:1536237388231982%657bacd6657bacd6"}]}
		      </td>
		    </tr>
		    

		    <tr>
		      <th scope="row">1</th>
		      <td>Login</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/login.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i)REQUEST :</b>
		      	<br>
		      	{"email":"","password":"", "DeviceID":""}
		      	<br>
		      	<b>(ii)RESPONSE :</b>
		      	<br>
		      	{"error":false,"uid":"5b114c25de5d92.04415953","user":{"name":"Rohan","email":"rohan@gmail.com","mobnumber":"9878787676","created_at":"2018-06-01 06:37:41","uuid":"281066471ed789b7"}}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">2</th>
		      <td>Registration</td>
		      <td colspan="2" colspan="3" class="wordwrap" class="wordwrap">http://iqexpert.in/android_login_api/register.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i)REQUEST :</b>
		      	<br>	
		      	{"name":"","email":"","password":"","mobnumber":"","uuid":"","device_type":"","device_id":""}
		      	<br> 
		      	<b>(ii)RESPONSE :</b>
		      	<br>
		      	{"error":false,"uid":"5b1788d0442e52.66525989","user":{"name":"tttt","email":"tttt@gmail.com","password":"dHR0dA==","mobnumber":"1234512345","created_at":"2018-06-06 00:10:08","uuid":"1"}}

		      </td>
		    </tr>
		    
		    <tr>
		      <th scope="row">3</th>
		      <td>Fetch Today 12 Slots</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/getRand.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i)REQUEST :</b>
		      	<br>
		      	NA
		      	<br>
		      	<b>(ii)RESPONSE :</b>
		      	<br>
		      	[{"play_slot_id":"44","playSlot":"D","date":"2018-05-30","time":"13:00","randValue":"686681","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:43","status":"active"},{"play_slot_id":"45","playSlot":"E","date":"2018-05-30","time":"14:00","randValue":"700397","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:43","status":"pending"},{"play_slot_id":"46","playSlot":"F","date":"2018-05-30","time":"15:00","randValue":"552544","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:43","status":"pending"},{"play_slot_id":"47","playSlot":"G","date":"2018-05-30","time":"16:00","randValue":"942026","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:43","status":"pending"},{"play_slot_id":"48","playSlot":"H","date":"2018-05-30","time":"17:00","randValue":"325403","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:44","status":"pending"},{"play_slot_id":"49","playSlot":"I","date":"2018-05-30","time":"18:00","randValue":"494639","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:44","status":"pending"},{"play_slot_id":"50","playSlot":"J","date":"2018-05-30","time":"19:00","randValue":"946512","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:44","status":"pending"},{"play_slot_id":"51","playSlot":"K","date":"2018-05-30","time":"20:00","randValue":"718697","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:44","status":"pending"},{"play_slot_id":"52","playSlot":"L","date":"2018-05-30","time":"21:00","randValue":"768744","createdDate":"2018-05-30 11:50:43","updatedDate":"2018-05-30 11:50:44","status":"pending"},{"play_slot_id":"57","playSlot":"D","date":"2018-05-30","time":"13:00","randValue":"285062","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:43","status":"active"},{"play_slot_id":"58","playSlot":"E","date":"2018-05-30","time":"14:00","randValue":"177787","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:43","status":"pending"},{"play_slot_id":"59","playSlot":"F","date":"2018-05-30","time":"15:00","randValue":"297749","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:43","status":"pending"},{"play_slot_id":"60","playSlot":"G","date":"2018-05-30","time":"16:00","randValue":"468793","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:43","status":"pending"},{"play_slot_id":"61","playSlot":"H","date":"2018-05-30","time":"17:00","randValue":"425011","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:43","status":"pending"},{"play_slot_id":"62","playSlot":"I","date":"2018-05-30","time":"18:00","randValue":"991666","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:44","status":"pending"},{"play_slot_id":"63","playSlot":"J","date":"2018-05-30","time":"19:00","randValue":"993902","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:44","status":"pending"},{"play_slot_id":"64","playSlot":"K","date":"2018-05-30","time":"20:00","randValue":"682019","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:44","status":"pending"},{"play_slot_id":"65","playSlot":"L","date":"2018-05-30","time":"21:00","randValue":"307555","createdDate":"2018-05-30 13:07:43","updatedDate":"2018-05-30 13:07:44","status":"pending"}]
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">4</th>
		      <td>Update User Profile</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/updateUser.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i)REQUEST :</b>
		      	<br>
		      	{"unique_id":"","name":,"email":"","image":"","mobnumber":""}
		      	<br>
		      	<b>(ii)RESPONSE :</b>
		      	<br>
		      	{"error":false,"user":{"uid":"5b114c25de5d92.04415953","name":"Rohan","email":"rohan@gmail.com","ProfilePic":"http:\/\/iqexpert.in\/android_login_api\/uploads\/1528188696.png","mobnumber":"89977978878","uuid":null}}

		      </td>
		    </tr>
		    <tr>
		      <th scope="row">5</th>
		      <td>Delete User Profile</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/deleteUser.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i)REQUEST :</b>
		      	<br>
		      	{"uid": ""}
		      	<br>
		      	<b>(ii)RESPONSE :</b>
		      	<br>
		      	[{"error":false,"msg":"Status Disabled !"}]
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">6</th>
		      <td>Bank Insert for Users</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/bankInsert.php</td>
		      <td colspan="3" class="wordwrap">
		      <b>(i) REQUEST :</b>
		      <br>
		      	{"uid":"","bankUUID":"","bankName":"","accHolderName":"","bankBranch":"","AccNo":"","IFSC":""}
		      <br>
		      <b>(ii) RESPONSE :</b>
		      <br>
		       {"error":false,"bank":{"uid":"3sdaeasd2e331","bankName":"Axis Bank","accHolderName":"ram","bankBranch":"thane","AccNo":"312413Afds1","IFSC":"87675676688"}}
		       <br> <i>OR</i>
		       {"error":true,"error_msg":" Kindly Enter Correct Details !"}
		   </td>
		    </tr>
		    <tr>
		      <th scope="row">7</th>
		      <td>Bank Update for Users</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/updateBank.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	{"uid":"","bankUUID":"","bankName":"","accHolderName":"","bankBranch":"","AccNo":"","IFSC":""}
		      	<br>
		      	(ii) RESPONSE :
		      	<br>
		      	{"error":false,"bank":{"uid":"5b16384f4b8504.39394722","bankUUID":"123456","bankName":"Axis","accHolderName":"Rohan Sable","bankBranch":"Kalyan","AccNo":"111","IFSC":"321","status":"Bank Details Updated Successfully !"}}
		      	<br> <i>OR</i>
		      	{"error":true,"error_msg":"Required parameters are missing!"}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">8</th>
		      <td>Delete Bank Against userId & bankUUID</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/deleteBank.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {uid:"" ,"bankUUID":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"bank":{"uid":"5b16384f4b8504.39394722","bankUUID":"123456","count":"2","status":"Bank Deleted Successfully!"}}
		      	<br><b>OR</b> When Final Bank<br>
		      	{"error":false,"bank":{"uid":"5b16384f4b8504.39394722","bankUUID":"1","count":0,"status":"Bank Deleted Successfully!"}}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">9</th>
		      <td>Get Bank Details against userId</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/getBank.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {uid:""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"AllBanks":[{"bank_id":"1","bank_uuid":"1","unique_id":"5b16384f4b8504.39394722","bank_name":"a","acc_holder_name":"Rohan","bank_branch":"Kalyan","acc_no":"111","IFSC_code":"321","created_at":"2018-09-11 17:15:22","updated_at":"0000-00-00 00:00:00"},{"bank_id":"2","bank_uuid":"2","unique_id":"5b16384f4b8504.39394722","bank_name":"b","acc_holder_name":"Rohan","bank_branch":"Kalyan","acc_no":"111","IFSC_code":"321","created_at":"2018-09-11 17:15:35","updated_at":"0000-00-00 00:00:00"},{"bank_id":"3","bank_uuid":"123456","unique_id":"5b16384f4b8504.39394722","bank_name":"Axis","acc_holder_name":"Rohan","bank_branch":"Kalyan","acc_no":"111","IFSC_code":"321","created_at":"2018-09-11 17:16:47","updated_at":"0000-00-00 00:00:00"}]}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">10</th>
		      <td>Bid Transaction Against Each User with their Band Details</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/bidTransaction.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {SlotNumber:"",SlotID:"",randValue:"",bid:"",amount:"",status:"",orderId:"",paymentId:"",token:"",UID:"",email:"",mobnumber:""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"bid":{"SlotNumber":"68","SlotID":"g","randValue":"506488","bidStatus":"low","status":"success","amount":"100","UID":"1","time":"16:40"}}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">11</th>
		      <td>Get Counting how many Users are Playing in Current Slot</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/getbidUsers.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {SlotNumber:""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"bid":{"countUser":"5"}}
		      </td>
		    </tr>
		    
		    <tr>
		      <th scope="row">12</th>
		      <td>Count Users with Suffle Number</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/countWithSuffle.php?SlotNumber=&randValue=
		      	<br>eg. 
		      	http://iqexpert.in/android_login_api/countWithSuffle.php?SlotNumber=C&randValue=506488
		      </td>

		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"SlotNumber":"","randValue":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"bid":{"countUser":"5","SlotNumber":"I","randValue":"548428","newrandValue":548407}}
		      </td>
		    </tr>
		    
		    <tr>
		      <th scope="row">13</th>
		      <td>Current Play Result</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/currPlayResult.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"SlotNumber":"","SlotID":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"currPlayResult":[{"slot_number":"1","slot_id":"A","u_id":"1","amount":"180","bid_pro_loss":"25","created_at":"2018-06-11 13:48:13"},{"slot_number":"1","slot_id":"A","u_id":"1","amount":"20","bid_pro_loss":"-12","created_at":"2018-06-11 13:48:34"},{"slot_number":"1","slot_id":"A","u_id":"1","amount":"30","bid_pro_loss":"-18","created_at":"2018-06-11 13:48:42"}]}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">14</th>
		      <td>Get History Play Result with Pagination</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/getHistoryPlay.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"UID":"","indexID":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"SlotNumber":"A","randValue":"123456","bid":"high","amount":"100","bidProLoss":"35.09933774834437","status":"success","created_at":"2018-06-18 17:12:27"},{"SlotNumber":"A","randValue":"123456","bid":"low","amount":"200","bidProLoss":"-120","status":"success","created_at":"2018-06-18 17:13:24"},{"SlotNumber":"A","randValue":"123456","bid":"low","amount":"220","bidProLoss":"-132","status":"success","created_at":"2018-06-18 17:13:32"},{"SlotNumber":"A","randValue":"123456","bid":"low","amount":"501","bidProLoss":"-300.59999999999997","status":"success","created_at":"2018-06-18 17:13:45"},{"SlotNumber":"A","randValue":"123456","bid":"high","amount":"314","bidProLoss":"110.21192052980132","status":"success","created_at":"2018-06-18 17:14:00"},{"SlotNumber":"A","randValue":"123456","bid":"high","amount":"314","bidProLoss":"110.21192052980132","status":"success","created_at":"2018-06-17 17:14:15"},{"SlotNumber":"A","randValue":"123456","bid":"high","amount":"314","bidProLoss":"110.21192052980132","status":"success","created_at":"2018-06-18 17:14:29"},{"SlotNumber":"B","randValue":"123456","bid":"low","amount":"500","bidProLoss":"-300","status":"success","created_at":"2018-06-18 17:14:50"},{"SlotNumber":"B","randValue":"123456","bid":"low","amount":"502","bidProLoss":"-301.2","status":"success","created_at":"2018-06-17 17:14:58"},{"SlotNumber":"C","randValue":"12345","bid":"high","amount":"90","bidProLoss":"6.976744186046512","status":"success","created_at":"2018-06-17 17:15:19"}]
		      </td>
		    </tr>
		    
		    <tr>
		      <th scope="row">15</th>
		      <td>Search History Play Result With Pagination</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/searchHistoryPlay.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"UID":"","IndexID":"","fromDate":"","toDate":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"SlotNumber":"A","randValue":"123456","bid":"high","amount":"314","bidProLoss":"110.21192052980132","status":"success","created_at":"2018-06-17 17:14:15"},{"SlotNumber":"B","randValue":"123456","bid":"low","amount":"502","bidProLoss":"-301.2","status":"success","created_at":"2018-06-17 17:14:58"},{"SlotNumber":"C","randValue":"12345","bid":"high","amount":"90","bidProLoss":"6.976744186046512","status":"success","created_at":"2018-06-17 17:15:19"},{"SlotNumber":"C","randValue":"12345","bid":"high","amount":"78","bidProLoss":"6.046511627906977","status":"success","created_at":"2018-06-17 17:16:16"}]
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">16</th>
		      <td>Get History of Payment Result with Pagination</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/getHistoryPayment.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"UID":"","indexID":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"SlotNumber":"A","randValue":"377110","bid":"high","amount":"100","status":"success","created_at":"2018-06-18 17:12:27"},{"SlotNumber":"A","bid":"low","amount":"200","status":"success","created_at":"2018-06-18 17:13:24"},{"SlotNumber":"A","randValue":"377110","bid":"low","amount":"220","status":"success","created_at":"2018-06-18 17:13:32"},{"SlotNumber":"A","randValue":"377110","bid":"low","amount":"501","status":"success","created_at":"2018-06-18 17:13:45"},{"SlotNumber":"A","randValue":"377110","bid":"high","amount":"314","status":"success","created_at":"2018-06-18 17:14:00"},{"SlotNumber":"A","randValue":"377110","bid":"high","amount":"314","status":"success","created_at":"2018-06-17 17:14:15"},{"SlotNumber":"A","randValue":"377110","bid":"high","amount":"314","status":"success","created_at":"2018-06-18 17:14:29"},{"SlotNumber":"B","randValue":"377110","bid":"low","amount":"500","status":"success","created_at":"2018-06-18 17:14:50"},{"SlotNumber":"B","randValue":"377110","bid":"low","amount":"502","status":"success","created_at":"2018-06-17 17:14:58"},{"SlotNumber":"C","randValue":"377110","bid":"high","amount":"90","status":"success","created_at":"2018-06-17 17:15:19"}]
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">17</th>
		      <td>Search History of Payment Result With Pagination</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/searchHistoryPayment.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"UID":"","IndexID":"","fromDate":"","toDate":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"SlotNumber":"A","randValue":"377110","bid":"high","amount":"314","status":"success","created_at":"2018-06-17 17:14:15"},{"SlotNumber":"B","randValue":"377110","bid":"low","amount":"502","status":"success","created_at":"2018-06-17 17:14:58"},{"SlotNumber":"C","randValue":"377110","bid":"high","amount":"90","status":"success","created_at":"2018-06-17 17:15:19"},{"SlotNumber":"C","randValue":"377110","bid":"high","amount":"78","status":"success","created_at":"2018-06-17 17:16:16"}]
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">18</th>
		      <td>Download Game</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/DownloadGame.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 NA
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"URL":"https:\/\/apkpure.com\/apkpure-app.html?icn=aegon&ici=image_down"}
		      </td>
		    </tr>
		    

		    <!-- PAYU  API -->
		    <tr>
		      <th scope="row">19</th>
		      <td>PayUMoney Hash Generation Response</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/PayUMoneyResponse.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {'amount','email','firstname','productinfo','txnid','key'}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"payment_hash":"e91014565d7fd9338db5eb43f6edf9c8cc226178a7e16dc687bdd959eceef88dbb9f6fa516385fb1e10f23fb9d8f90cbde073dc5828030283523f2ec45bcf632","get_merchant_ibibo_codes_hash":"e625313ec027ceb6b68f4cee67b9508d8018d95699414a3f57d29dc447b893f9a9112ba314313376260dfa13cbc914004eb57357c7fa861e019036f43839672d","vas_for_mobile_sdk_hash":"be6ee1abc6660d3e5ab3975e096695e46335c932e224abe5f45589d5b2dbaa578c3e82c42c22196a31e6d5490a8e44ac006c1ccaf0777c84256c6432982f9c91","payment_related_details_for_mobile_sdk_hash":"07bce3836733363a6eed87ffc59244eb8ef9412c68f1a83d128df46190c6e2b60fbeecb3edd6833a2855fd8a67af6abe941318e74f37b2b7d7c848a70ffcbde3","verify_payment_hash":"9b95da83a9924705d34772f9aca09b7605da5b35a3690622ef7f1b8b6f588dd2b2bb3971fe6ce8645239e6a25766e6df11afca0121b65b1117044f9806a18976","send_sms_hash":"353682d7663b0136293e044f9b55639d9eaa8e361d23aecc4eeb522dff13d1d5a6aa3e8cd9bc138a5f74d633d4fd29ac757027011857c89128cd34f770898308"}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">20</th>
		      <td>PayUMoney Deposit Request</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/PayUMoneyDeposit.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {'uid','FullName','BankName','AccountID','IFSC','type','depositAmount'}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"bank":{"uid":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","WalletAmount":"1000","msg":"Data Entered!"}}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">21</th>
		      <td>PayUMoney WithDrawl Request</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/PayUMoneyWithdrawlRequest.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {'uid','FullName','BankName','AccountID','IFSC','type','withdrawalAmount'}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"bank":{"uid":"5b114c25de5d92.04415953","FullName":"Abc","BankName":"Axis","AccountID":"1","IFSC":"1","type":"withdrawal","withdrawalAmount":"100","WalletAmount":"800","msg":"Data Entered!"}}
		      </td>
		    </tr>
			<tr>
		      <th scope="row">22</th>
		      <td>PayUMoney Wallet Amount Against UID</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/PayUMoneyWallet.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {'uid'}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"wallet":{"uid":"5b114c25de5d92.04415953","amount":"4100"}}
		      	<br><i>OR</i> {"error":false,"wallet":{"uid":"5b114c25de5d92.044159531","amount":0}}
		      </td>
		    </tr>
			<!-- PAYU  API -->

			<tr>
		      <th scope="row">23</th>
		      <td>Updated Suffle Number For Current Slot</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/UpdatedSuffle.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {'SlotNumber'}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"suffle":{"SlotNumber":"I","randValue":"556979","newrandValue":"556444","countUsers":"2","status":"true"}}OR
		      	{"error":false,"suffle":{"SlotNumber":"I","randValue":"556979","newrandValue":"556444","countUsers":"2","status":"false"}}
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">24</th>
		      <td>Get History of PayUMoney Transaction with Pagination</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/getHistoryPayUTransaction.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"UID":"","indexID":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"payU_id":"1","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","withdrawalAmount":"","created_at":"2018-09-11 12:19:15","updated_at":null},{"payU_id":"2","unique_id":"5b114c25de5d92.04415953","FullName":"Abc","BankName":"Axis","AccountID":"1","IFSC":"1","type":"withdrawal","depositAmount":"","withdrawalAmount":"100","created_at":"2018-09-11 12:23:37","updated_at":null},{"payU_id":"3","unique_id":"5b114c25de5d92.04415953","FullName":"Abc","BankName":"Axis","AccountID":"1","IFSC":"1","type":"withdrawal","depositAmount":"","withdrawalAmount":"100","created_at":"2018-09-11 12:24:57","updated_at":null},{"payU_id":"4","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"100","withdrawalAmount":"","created_at":"2018-09-12 12:37:40","updated_at":null},{"payU_id":"5","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"100","withdrawalAmount":"","created_at":"2018-09-12 12:37:43","updated_at":null},{"payU_id":"6","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"100","withdrawalAmount":"","created_at":"2018-09-12 12:37:45","updated_at":null},{"payU_id":"7","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","withdrawalAmount":"","created_at":"2018-09-12 12:37:51","updated_at":null},{"payU_id":"8","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","withdrawalAmount":"","created_at":"2018-09-12 12:37:53","updated_at":null},{"payU_id":"9","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","withdrawalAmount":"","created_at":"2018-09-12 12:37:58","updated_at":null},{"payU_id":"10","unique_id":"5b114c25de5d92.04415953","FullName":"Abc","BankName":"Axis","AccountID":"1","IFSC":"1","type":"withdrawal","depositAmount":"","withdrawalAmount":"100","created_at":"2018-09-12 12:39:03","updated_at":null}]
		      </td>
		    </tr>
		    <tr>
		      <th scope="row">25</th>
		      <td>Search History of PayUMoney Transaction With Pagination</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/searchHistoryPayUTransaction.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"UID":"","IndexID":"","fromDate":"","toDate":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"payU_id":"1","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","withdrawalAmount":"","created_at":"2018-09-11 12:19:15","updated_at":null},{"payU_id":"2","unique_id":"5b114c25de5d92.04415953","FullName":"Abc","BankName":"Axis","AccountID":"1","IFSC":"1","type":"withdrawal","depositAmount":"","withdrawalAmount":"100","created_at":"2018-09-11 12:23:37","updated_at":null},{"payU_id":"3","unique_id":"5b114c25de5d92.04415953","FullName":"Abc","BankName":"Axis","AccountID":"1","IFSC":"1","type":"withdrawal","depositAmount":"","withdrawalAmount":"100","created_at":"2018-09-11 12:24:57","updated_at":null},{"payU_id":"4","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"100","withdrawalAmount":"","created_at":"2018-09-12 12:37:40","updated_at":null},{"payU_id":"5","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"100","withdrawalAmount":"","created_at":"2018-09-12 12:37:43","updated_at":null},{"payU_id":"6","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"100","withdrawalAmount":"","created_at":"2018-09-12 12:37:45","updated_at":null},{"payU_id":"7","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","withdrawalAmount":"","created_at":"2018-09-12 12:37:51","updated_at":null},{"payU_id":"8","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","withdrawalAmount":"","created_at":"2018-09-12 12:37:53","updated_at":null},{"payU_id":"9","unique_id":"5b114c25de5d92.04415953","FullName":"abc","BankName":"SBI","AccountID":"1","IFSC":"1","type":"deposit","depositAmount":"1000","withdrawalAmount":"","created_at":"2018-09-12 12:37:58","updated_at":null},{"payU_id":"10","unique_id":"5b114c25de5d92.04415953","FullName":"Abc","BankName":"Axis","AccountID":"1","IFSC":"1","type":"withdrawal","depositAmount":"","withdrawalAmount":"100","created_at":"2018-09-12 12:39:03","updated_at":null}]
		      </td>
		    </tr>
			
			<tr>
		      <th scope="row">26</th>
		      <td>Current DateTime</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/DateTime.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 NA
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"dateTime":"2018-09-18 17:57:28"}
		      </td>
		    </tr>
		    

		    <tr class="AdminAPI">
		      <th scope="row">I</th>
		      <td>Counting For Register / Slot / High / Low</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/counter.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 NA
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	{"error":false,"count":{"currentRegisterUsers":"4","currentbidAllUsers":"3","currentbidHighUsers":"2","currentbidLowUsers":"1"}}
		      </td>
		    </tr>
		    <tr class="AdminAPI">
		      <th scope="row">II</th>
		      <td>Searching For Register / Slot / High / Low</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/allTransaction.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 NA
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"name":"r","uid":"1","HighValue":"2940","LowValue":"5050","TotalValue":"7990"},{"name":"Rohan","uid":"5b114c25de5d92.04415953","HighValue":"1300","LowValue":"1963","TotalValue":"3263"}]
		      </td>
		    </tr>
		    <tr class="AdminAPI">
		      <th scope="row">III</th>
		      <td>Searching with Character For Register / Slot / High / Low</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/searchTransaction.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 {"character":""}
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"name":"r","uid":"1","HighValue":"2940","LowValue":"5050","TotalValue":"7990"},{"name":"Rohan","uid":"5b114c25de5d92.04415953","HighValue":"1300","LowValue":"1963","TotalValue":"3263"}]
		      </td>
		    </tr>
		    <tr class="AdminAPI">
		      <th scope="row">IV</th>
		      <td>Live Play Status</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/livePlayStatus.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 NA
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"name":"LMN","slot_id":"h","amount":"120","created_at":"2018-07-02 15:00:34"}]
		      </td>
		    </tr>
		    <tr class="AdminAPI">
		      <th scope="row">V</th>
		      <td>PayUMoney Users Status</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/PayUMoneyUsers.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 NA
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"payU_id":"1","unique_id":"1","FullName":"Test","BankName":"PNB","AccountID":"1","IFSC":"1","type":"withdrawal","depositAmount":"","withdrawalAmount":"100","created_at":"2018-09-04 13:12:39","updated_at":"0000-00-00 00:00:00"},{"payU_id":"2","unique_id":"2","FullName":"Demo","BankName":"Axis","AccountID":"1","IFSC":"1","type":"withdrawal","depositAmount":"","withdrawalAmount":"230","created_at":"2018-09-04 13:16:41","updated_at":"0000-00-00 00:00:00"}]
		      </td>
		    </tr>
		    <tr class="AdminAPI">
		      <th scope="row">VI</th>
		      <td>Game Transaction</td>
		      <td colspan="2" class="wordwrap">http://iqexpert.in/android_login_api/GameTransaction.php</td>
		      <td colspan="3" class="wordwrap">
		      	<b>(i) REQUEST :</b>
		      	<br>
		      	 NA
		      	<br>
		      	<b>(ii) RESPONSE :</b>
		      	<br>
		      	[{"t_id":"1","slot_number":"1","slot_id":"A","randValue":"312312","bid":"high","amount":"10","bid_pro_loss":"10","finalAmount":"10","Payment_Status":"Done","status":"success","order_id":"1","payment_id":"1","token":"1","u_id":"5b16384f4b8504.39394722","email":"sablerohan@gmail.com","mobnumber":"9987231886","created_at":"2018-06-05 12:44:23","updated_at":null,"user_id":"1","unique_id":"5b16384f4b8504.39394722","name":"ABC","encrypted_password":"Um9oYW4=","ProfilePic":"http:\/\/iqexpert.in\/android_login_api\/uploads\/1528354075.png","flag":"Enable"},{"t_id":"3","slot_number":"14","slot_id":"K","randValue":"377110","bid":"low","amount":"300","bid_pro_loss":"20","finalAmount":"-10","Payment_Status":"Pending","status":"success","order_id":"1","payment_id":"1","token":"1","u_id":"5b16384f4b8504.39394722","email":"sablerohan@gmail.com","mobnumber":"9987231886","created_at":"2018-06-05 12:44:23","updated_at":null,"user_id":"1","unique_id":"5b16384f4b8504.39394722","name":"ABC","encrypted_password":"Um9oYW4=","ProfilePic":"http:\/\/iqexpert.in\/android_login_api\/uploads\/1528354075.png","flag":"Enable"},{"t_id":"4","slot_number":"1","slot_id":"F","randValue":"123123","bid":"high","amount":"30","bid_pro_loss":"-20","finalAmount":"10","Payment_Status":"Pending","status":"success","order_id":"2","payment_id":"2","token":"2","u_id":"5b16384f4b8504.39394722","email":"sablerohan@gmail.com","mobnumber":"9987231886","created_at":"2018-06-05 12:44:23","updated_at":null,"user_id":"1","unique_id":"5b16384f4b8504.39394722","name":"ABC","encrypted_password":"Um9oYW4=","ProfilePic":"http:\/\/iqexpert.in\/android_login_api\/uploads\/1528354075.png","flag":"Enable"},{"t_id":"5","slot_number":"1","slot_id":"L","randValue":"123123","bid":"low","amount":"40","bid_pro_loss":"10","finalAmount":"50","Payment_Status":"Pending","status":"success","order_id":"2","payment_id":"2","token":"2","u_id":"5b16384f4b8504.39394723","email":"test@gmail.com","mobnumber":"99879797979","created_at":"2018-06-13 13:04:41","updated_at":null,"user_id":"9","unique_id":"5b16384f4b8504.39394723","name":"LMN","encrypted_password":"MTIzNDU=","ProfilePic":"http:\/\/iqexpert.in\/android_login_api\/uploads\/1529822458.png","flag":"Enable"}]
		      </td>
		    </tr>
		  </tbody>
		</table>
	</div>

<!-- <a href="http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/">http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/</a> -->

</body>
</html>