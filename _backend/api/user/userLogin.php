<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";

$user = new User($db);
$result = $user->userLogin();
$num = $result->rowCount();

if ($num > 0) {
    $users = [
        'code' => 1,
        'status' => 200,
        'msg' => "Get All Users Successfully!",
    ];

    $users['data'] = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data = [
            'id' => $id,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'address' => $address,
            'status' => $status,
            'role' => $role,
            'avatar' => $avatar
        ];
        array_push($users['data'], $data);
    }
    header("HTTP/1.0 200 OK");
    echo json_encode($users, JSON_PRETTY_PRINT);
} else {
    $users = [
        'code' => 0,
        'status' => 404,
        'msg' => "Get All Users Unsuccessfully!",
        'data' => null
    ];
    header("HTTP/1.0 404 User Not Found");
    echo json_encode($users, JSON_PRETTY_PRINT);
}

?>