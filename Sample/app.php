<?php
	require_once("config.php");
	$registatoin_ids = array();

	//レジストレーションIDの配列セット
	array_push($registatoin_ids, DEVICE_REGI_ID);

	$name = "name";
	$title = "title";
	$message = "message";

	$gcm = new GCM();
	$send_content = array("name"=> $name ,"title"=> $title ,"message"=> $message);

	$result_android = $gcm->send_notification($registatoin_ids,$send_content,$ttl);

	class GCM{
		function __construct(){}
			public function send_notification($registatoin_ids,$send_content){
				$url = "https://android.googleapis.com/gcm/send";
				$fields = array(
								"collapse_key" => "score_update",
								"delay_while_idle" => true,
								"registration_ids" => $registatoin_ids,
								"data" => $send_content
								);

				$headers = array(
								"Authorization: key=".GOOGLE_API_KEY,
								"Content-Type: application/json"
								);
				$ch = curl_init();
							curl_setopt($ch,CURLOPT_URL,$url);
							curl_setopt($ch,CURLOPT_POST,true);
							curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
							curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
							curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
							curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
							$result = curl_exec($ch);
							if($result === FALSE){
								die("Curl failed: ".curl_error($ch));
							}
						curl_close($ch);
						echo $result;
						}
		}
?>
