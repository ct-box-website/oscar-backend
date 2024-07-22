<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(0);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: POST");
header("Content-Type: application/json");

include_once "../../config/init.php";

$user = new User($db);
// $user->id = isset($_POST["id"]) ?? die();

if (isset($_POST["id"])) {
    switch (($_POST["id"])) {
        case "":
            $erro = $user->error404("User Not Found");
            echo $erro;
            break;
        default:
            $user->id = $_POST["id"];
            $user->readById();
            $users = [
                "id" => $user->id,
                "username" => $user->username,
                "password" => $user->password,
                "email" => $user->email,
                "address" => $user->address,
                'status' => $user->status,
                'avatar' => $user->avatar
            ];

            $data = [
                'code' => 1,
                'status' => 200,
                'msg' => 'Get single user successfully!',
                'data' => $users
            ];

            header("HTTP/1.0 200 OK");
            echo json_encode($data, JSON_PRETTY_PRINT);
            break;
    }
} else {
    $erro = $user->error404("User Not Found");
    echo $erro;
}

?>