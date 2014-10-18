<?php
include_once './DbConnect.php';

function getUser(){
    $user_id = $_POST["USER_ID"];

    // array for json response
    $response = array();
    $response["room"] = array();

    // Mysql select query
    $query = "SELECT * FROM ROOM WHERE OWNER_ID = '$user_id";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {
        $tmp = array();
        $tmp["owner_id"] = $row["OWNER_ID"];
        $tmp["ride_date"] = $row["RIDE_DATE"];
        $tmp["ride_time"] = $row["RIDE_TIME"];
        $tmp["time_type"] = $row["TIME_TYPE"];
        $tmp["railway_id"] = $row["RAILWAY_ID"];
        $tmp["ride_st"] = $row["RIDE_ST"];
        $tmp["dest_st"] = $row["DEST_ST"];
        $tmp["car_num"] = $row["CAR_NUM"];
        $tmp["use_flg"] = $row["USE_FLG"];

        // push category to final json array
        array_push($response["room"], $tmp);
    }

    // keeping response header to json
    header('Content-Type: application/json');

    // echoing json result
    echo json_encode($response);
}

getUser();
?>