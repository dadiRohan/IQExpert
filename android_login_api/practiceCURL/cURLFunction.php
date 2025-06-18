<?php
class CURL {

	/*
	* Get JSON Data with Parameters Url & Request 
	*/
	public function getjsondata($url,$request = array()){

		$ch = curl_init();
		// $data_string = json_encode($data);
		$data_string = http_build_query($request);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}


	/*
	* Get ARRAY Data with Parameters Url & Request 
	*/
	public function getarraydata($url,$request = array()){

		$ch = curl_init();
		// $data_string = json_encode($data);
		$data_string = http_build_query($request);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		$arrayOutput = json_decode($output,true);
		return $arrayOutput;
	}
}

?>