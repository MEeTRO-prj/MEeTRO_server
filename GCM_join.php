<?php
include_once './DbConnect.php';
//レジストレーションIDの配列セット
$registatoin_ids = array();
$room_id = $_POST["ROOM_ID"];
$owner_id = $_POST["OWNER_ID"];
$user_name = $_POST["USER_NAME"];

$title = "Friend joined your room!";
$message = $user_name." joined your room!";

// DBからOwnerのRegistrationIdを取得する
$query = "SELECT * FROM ROOM R JOIN USER U ON R.OWNER_ID = U.USER_ID WHERE R.ROOM_ID = '$room_id'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    array_push($registatoin_ids, $row["REGI_ID"]);
    //$regi_id = $row["REGI_ID"];
}

$gcm = new GCM();
$send_content = array("name"=> $user_name ,"title"=> $title ,"message"=> $message);

$result_android = $gcm->send_notification($registatoin_ids, $send_content);

class GCM{
	function __construct(){}
	public function send_notification($registatoin_ids, $send_content){
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
