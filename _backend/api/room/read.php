<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";

$user = new Room($db);
$result = $user->readRoom();
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
            'title' => $title,
            'description' => $description,
            'category_id' => $category_id,
            'price' => $price,
            'status' => $status,
            'scale' => $scale,
            'images' => $images,
            'category_name' => $category_name,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
        array_push($users['data'], $data);
    }
    header("HTTP/1.0 200 OK");
    echo json_encode($users, JSON_PRETTY_PRINT);
} else {
    $users = [
        'code' => 0,
        'status' => 404,
        'msg' => "Get All Room Unsuccessfully!",
        'data' => null
    ];
    header("HTTP/1.0 404 User Not Found");
    echo json_encode($users, JSON_PRETTY_PRINT);
}

?>