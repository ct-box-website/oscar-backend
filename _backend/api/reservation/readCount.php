<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";

$reservation = new Reservation($db);
$result = $reservation->readCount();

if ($result->rowCount() > 0) {
    $response = [
        'code' => 1,
        'status' => 200,
        'msg' => "Get Reservation Count Successfully!",
    ];
    $response['data'] = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data = [
            'total' => $id,
        ];
        array_push($response['data'], $data);
    }
    header("HTTP/1.0 200 OK");
    echo json_encode($response, JSON_PRETTY_PRINT);
}

?>