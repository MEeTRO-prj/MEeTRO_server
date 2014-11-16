<?php
include_once './DbConnect.php';

$registatoin_id = array();
$room_id = $_POST["ROOM_ID"];
$user_id = $_POST["USER_ID"];
$user_name = $_POST["USER_NAME"];

// DBから自分以外の部屋参加者のRegistrationIdを取得する
$query = "SELECT U.REGI_ID FROM MEMBER M JOIN USER U ON M.USER_ID = U.USER_ID WHERE M.ROOM_ID = '$room_id' AND M.USER_ID != '$user_id'";
// $query = "SELECT * FROM ROOM R JOIN USER U ON R.OWNER_ID = U.USER_ID WHERE R.ROOM_ID = '$room_id'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    array_push($registatoin_id, $row["REGI_ID"]);
}

//送りたいメッセージ
$notificationMsg = "You got a message from MEeTRO.";
$roomId   = $room_id;
$msgTitle = "MEeTRO's information";
$msgContext = $user_name." is late on room [".$room_id."].";

$response = sendNotification(
               GOOGLE_API_KEY,
               $registatoin_id,
               array(
                'notificationMsg' => $notificationMsg,
                'msgTitle' => $msgTitle,
                'msgContext' => $msgContext)
               );

echo $response;

function sendNotification( $apiKey, $registrationIdsArray, $messageData )
{
   $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $apiKey);
   $data = array(
       'data' => $messageData,
       'registration_ids' => $registrationIdsArray
   );

   $ch = curl_init();

   curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
   curl_setopt( $ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send" );
   curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
   curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
   curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
   curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data) );

   $response = curl_exec($ch);
   curl_close($ch);

   return $response;
}
?>
