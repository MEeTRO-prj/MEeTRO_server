<?php
include_once './DbConnect.php';

function createNewUser() {
  if (isset($_POST["OWNER_ID"]) && $_POST["OWNER_ID"] != "") {
   // response array for json
   $response = array();
   $owner_id = $_POST["OWNER_ID"];
   $ride_date = $_POST["RIDE_DATE"];
   $ride_time = $_POST["RIDE_TIME"];
   $time_type = $_POST["TIME_TYPE"];
   $railway_id = $_POST["RAILWAY_ID"];
   $ride_st = $_POST["RIDE_ST"];
   $dest_st = $_POST["DEST_ST"];

   // mysql query
   $query = "INSERT INTO ROOM (ROOM_ID, OWNER_ID, RIDE_DATE, RIDE_TIME, TIME_TYPE, RAILWAY_ID, RIDE_ST, DEST_ST, CAR_NUM, UPDATED_DATE, USE_FLG) VALUES(NULL, '$owner_id', '$ride_date', '$ride_time', '$time_type', '$railway_id', '$ride_st', '$dest_st', 1, SYSDATE(), '0')";
   $result = mysql_query($query) or die(mysql_error());

   if ($result) {
    $response["error"] = false;
    $response["message"] = "Room created successfully!";
    $selected = mysql_query("SELECT ROOM_ID FROM ROOM WHERE OWNER_ID = '$owner_id' ORDER BY ROOM_ID DESC LIMIT 1");
    while ($row = mysql_fetch_array($selected)) {
      $response["room_id"] = $row["ROOM_ID"];
    }
    $room_id = $row["ROOM_ID"];
    $query2 = "INSERT INTO MEMBER (MEMBER_ID, ROOM_ID, OWNER_ID, RIDE_ST, RIDE_TIME) VALUES(NULL, '$room_id' '$owner_id', '$ride_st', '$ride_time')";
    $result2 = mysql_query($query2) or die(mysql_error());
  } else {
    $response["error"] = true;
    $response["message"] = "Failed to create room!";
  }
} else {
 $response["error"] = true;
 $response["message"] = "Owner Id is missing!";
}
// echo json response
echo json_encode($response);
}

createNewUser();
?>
