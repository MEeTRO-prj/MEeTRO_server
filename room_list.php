<?php
include_once './DbConnect.php';

function getRoomList(){
    $user_id = $_POST["USER_ID"];

    // array for json response
    $response = array();
    $response["room"] = array();

    // Mysql select query
    $query = "SELECT * FROM ROOM R JOIN MEMBER M ON R.ROOM_ID = M.ROOM_ID WHERE M.USER_ID = '$user_id' ORDER BY R.ROOM_ID";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {
        $tmp = array();
        $tmp["room_id"] = $row["ROOM_ID"];
        $tmp["owner_id"] = $row["OWNER_ID"];
        $tmp["ride_date"] = $row["RIDE_DATE"];
        $tmp["ride_time"] = $row["RIDE_TIME"];
        $tmp["time_type"] = $row["TIME_TYPE"];
        $tmp["railway_id"] = $row["RAILWAY_ID"];
        $tmp["ride_st"] = $row["RIDE_ST"];
        $tmp["dest_st"] = $row["DEST_ST"];
        $tmp["end_st"] = $row["END_ST"];
        $tmp["train_type"] = $row["TRAIN_TYPE"];
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

getRoomList();
?>
