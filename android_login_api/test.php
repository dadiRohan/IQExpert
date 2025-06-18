<?php
ini_set('display_errors','on');

/*echo $var = 'Rohan';

echo '<br>'.$en = base64_encode($var);
	
echo '<br>'.$de = base64_decode($en);

$string  = 'Encoding and Decoding Encrypted PHP Code';
$encoded = base64_encode($string);
$decoded = base64_decode($encoded);
echo $encoded ."\n";
echo $decoded;*/

/*
//New FTP Details
FTP PATH: 
http://iqexpert.in/images/
OR
/home/tmjyomds6t7l/public_html/Images

Username : Ideator@iqexpert.in
Password : Ideators@123*/

/*if(isset($_REQUEST['email'])){
	
	$email = $_REQUEST['email'];

	$explodeAddr = explode('@',$email);

	// echo '<br>'.$explodeAddr[1];

	$verified = array(
		0 => 'gmail.com',
		1 => 'yahoo.com',
		2 => 'yahoo.in',
		3 => 'rediffmail.com'
	);

	// in_array(needle, haystack)

	if(in_array($explodeAddr[1], $verified)){
		// echo 'Done';
		echo 'Valid ID: '.$email;
	}else{
	
		echo 'Not Valid ID';
	}
}*/

// header("Refresh:2; url=#header");
?>
<!DOCTYPE html>
<html>
<head>
<title>Test</title>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		// $('#random').onload(function(){
			// refreshTable();
				function refreshTable(){
			    $('#random').load('test.php', function(){
			       		setTimeout(refreshTable, 5000);
			    	});
				}
		// }); 	
	});
</script>
</head>
<body>
	<div id="header">
		<div id="random">
			Testing refresh Value : <?php echo rand(100,200); ?>
		</div>
	</div>
	
	<!-- <div id="form">
		<form action="" method="post">
			<input type="email" name="email" placeholder="email"><br/>
			<input type="submit" name="" />
		</form>
	</div> -->

	<div id="test">
		My own Div <?php echo rand(100,200);?>
	</div>
	<div id="test">
		My own Div2
	</div>
</body>
</html>
