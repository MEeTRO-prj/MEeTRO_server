<?php
include_once './DbConnect.php';

function updateUser(){
  if (isset($_POST["USER_ID"]) && $_POST["USER_ID"] != "") {
   // response array for json
   $response = array();
   $user_id = $_POST["USER_ID"];
   $regi_id = $_POST["REGI_ID"];

   // mysql query
   $query = "UPDATE USER SET REGI_ID = '$regi_id' WHERE USER_ID = '$user_id'";
   $result = mysql_query($query) or die(mysql_error());
   if ($result) {
    $response["error"] = false;
    $response["message"] = "User updated successfully!";
  } else {
    $response["error"] = true;
    $response["message"] = "Failed to update user!";
  }
} else {
 $response["error"] = true;
 $response["message"] = "USER_ID is missing!";
}
// echo json response
echo json_encode($response);
}

updateUser();
?>