<?php
header("Access-Control-Allow-Origin:*"); # allow everything
header("Content-Type: application/json");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

include_once "../../config/init.php";

$room = new Room($db);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $room->id = $_POST["id"];
        $data = $room->delete();
        echo $data;
        break;
    default:
        $data = [
            'code' => 0,
            'status' => 404,
            'msg' => 'Failed to delete room',
            'data' => null
        ];
        echo json_encode($data, JSON_PRETTY_PRINT);

}

?>