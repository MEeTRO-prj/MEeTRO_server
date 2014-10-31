<?php
include_once './DbConnect.php';

function joinRoom() {
  if (isset($_POST["USER_ID"]) && $_POST["USER_ID"] != "") {
   // response array for json
   $response = array();
   $room_id = $_POST["ROOM_ID"];
   $user_id = $_POST["USER_ID"];
   $ride_st = $_POST["RIDE_ST"];
   $ride_time = $_POST["RIDE_TIME"];

   // mysql query
   $query = "INSERT INTO MEMBER (MEMBER_ID, ROOM_ID, USER_ID, RIDE_ST, RIDE_TIME) VALUES(NULL, '$room_id', '$user_id', '$ride_st', '$ride_time')";
   $result = mysql_query($query) or die(mysql_error());

   if ($result) {
    $response["error"] = false;
    $response["message"] = "Join Room successfully!";
  } else {
    $response["error"] = true;
    $response["message"] = "Failed to join room!";
  }
} else {
 $response["error"] = true;
 $response["message"] = "User Id is missing!";
}
// echo json response
echo json_encode($response);
}

joinRoom();
?>
