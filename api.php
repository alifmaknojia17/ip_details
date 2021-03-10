<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, HEAD, OPTIONS, PATCH, PROPFIND, PROPPATCH, MKCOL, COPY, MOVE, LOCK");
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Expose-Headers: *");

if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!="") {
	//$ip_address = $_SERVER['REMOTE_ADDR']; //Production 
	$ip_address = '151.39.47.165'; //DEV
	$ip_details = fetch_ip_address_details($ip_address);
	echo response($ip_address, $ip_details, 200, "Success");
}else{
	response(NULL, NULL, 400,"Invalid Request");
	}

function response($ip_address,$ip_details,$response_code,$response_desc){
	$response['ip_address'] = $ip_address;
	$response['ip_details'] = $ip_details;
	$response['response_code'] = $response_code;
	$response['response_desc'] = $response_desc;
	
	$json_response = json_encode($response);
	return $json_response;
}

function fetch_ip_address_details($ip_address){
	$url = "https://ipinfo.io/".$ip_address."?token=694b73348e9e89";

 	$client = curl_init($url);
 	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
 	$response = curl_exec($client);

	return json_decode($response);
}
?>