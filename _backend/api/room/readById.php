<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: POST");
header("Content-Type: application/json");

include_once "../../config/init.php";

$room = new Room($db);

if (isset($_POST["id"])) {
    switch ($_POST["id"]) {
        case "":
            $erro = $room->error404("Room Not Found");
            echo $erro;
            break;
        default:
            $room->id = $_POST["id"];
            $room->readById();
            $data = [
                'code' => 1,
                'status' => 200,
                'msg' => 'Get single room successfully!',
                'data' => [
                    'id' => $room->id,
                    'title' => $room->title,
                    'description' => $room->description,
                    'price' => $room->price,
                    'created_at' => $room->created_at,
                    'updated_at' => $room->updated_at,
                    'category_id' => $room->category_id,
                    'images' => $room->images,
                    'status' => $room->status,
                    'scale' => $room->scale,
                ]
            ];

            header("HTTP/1.0 200 OK");
            echo json_encode($data, JSON_PRETTY_PRINT);
            break;
    }

} else {
    $data = [
        'code' => 0,
        'status' => 404,
        'msg' => 'Room ID Required',
        'data' => null
    ];
    header("HTTP/1.0 404 Room Not Found");
    echo json_encode($data, JSON_PRETTY_PRINT);
}

?>