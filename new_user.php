<?php
include_once './DbConnect.php';

function createNewUser() {
  if (isset($_POST["USER_NAME"]) && $_POST["USER_NAME"] != "") {
       // response array for json
       $response = array();
       $regi_id = $_POST["REGI_ID"];
       $user_name = $_POST["USER_NAME"];

       // mysql query
       $query = "INSERT INTO USER (REGI_ID, USER_NAME) VALUES('$regi_id', '$user_name')";
       $result = mysql_query($query) or die(mysql_error());
       if ($result) {
              $response["error"] = false;
              $response["message"] = "User created successfully!";
              $response["user_id"] = mysql_query("SELECT USER_ID FROM USER WHERE REGI_ID = '$regi_id' ORDER BY USER_ID DESC");
       } else {
              $response["error"] = true;
              $response["message"] = "Failed to create user!";
       }
 } else {
 $response["error"] = true;
 $response["message"] = "User name is missing!";
 }

// echo json response
   echo json_encode($response);
 }

createNewUser();
?>
