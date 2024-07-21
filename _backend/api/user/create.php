<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With, Access-Control-Allow-Method");

include_once "../../config/init.php";
$user = new User($db);
$requestMethod = $_SERVER["REQUEST_METHOD"];
$input = json_decode(file_get_contents("php://input"), true);

switch ($requestMethod) {
    case "POST":
        $data = (empty($input)) ? $user->create($_POST) : $user->create($input);
        echo $data;
        break;
    default:
        $data = [
            'code' => 0,
            'status' => 405,
            'msg' => "$requestMethod Method Not Allow"
        ];
        header("HTTP/1.0 405 Method Not Allow");
        echo json_encode($data);
        break;
}


?>