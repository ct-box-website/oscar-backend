<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";
$roomCount = new Room($db);
$result = $roomCount->readCount();
$num = $result->rowCount();

if ($num > 0) {
    $room = [
        'code' => 1,
        'status' => 200,
        'msg' => "Get Room Count Successfully!",
    ];
    $room['data'] = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data = [
            'total' => $id,
        ];
        array_push($room['data'], $data);
    }
    header("HTTP/1.0 200 OK");
    echo json_encode($room, JSON_PRETTY_PRINT);
}

?>