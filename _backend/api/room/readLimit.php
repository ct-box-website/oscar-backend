<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";

$room = new Room($db);
$result = $room->readLimit();
$num = $result->rowCount();

if ($num > 0) {
    $room = [
        'code' => 1,
        'status' => 200,
        'msg' => "Get Rooms Successfully!",
    ];
    $room['data'] = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data = [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'category_id' => $category_id,
            'price' => $price,
            'status' => $status,
            'scale' => $scale,
            'images' => $images,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];
        array_push($room['data'], $data);
    }
    header("HTTP/1.0 200 OK");
    echo json_encode($room, JSON_PRETTY_PRINT);
}


?>