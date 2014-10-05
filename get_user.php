<?php
include_once './DbConnect.php';

function getUser(){
    // array for json response
    $response = array();
    $response["user"] = array();

    // Mysql select query
    $result = mysql_query("SELECT * FROM USER");

    while ($row = mysql_fetch_array($result)) {
        $tmp = array();
        $tmp["id"] = $row["USER_ID"];
        $tmp["regi_id"] = $row["REGI_ID"];
        $tmp["name"] = $row["USER_NAME"];

        // push category to final json array
        array_push($response["user"], $tmp);
    }

    // keeping response header to json
    header('Content-Type: application/json');

    // echoing json result
    echo json_encode($response);
}

getUser();
?>