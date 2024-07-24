<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";

$category = new Category($db);


# Read all categories
$result = $category->read();
$num = $result->rowCount();

if ($num > 0) {
    $categories = [
        'code' => 1,
        'status' => 200,
        'msg' => "Get All Categories Successfully!",
    ];

    $categories['data'] = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data = [
            'id' => $id,
            'category_name' => $category_name,
            'status' => $status,
            'price' => $price,
            'created_at' => $created_at,
        ];
        array_push($categories['data'], $data);
    }
    header("HTTP/1.0 200 OK");
    echo json_encode($categories, JSON_PRETTY_PRINT);
} else {
    $categories = [
        'code' => 0,
        'status' => 404,
        'msg' => "Get All Categories Unsuccessfully!",
        'data' => null
    ];
    header("HTTP/1.0 404 User Not Found");
    echo json_encode($categories, JSON_PRETTY_PRINT);
}

?>