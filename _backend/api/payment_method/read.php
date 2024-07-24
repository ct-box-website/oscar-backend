<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";

$payment_method = new Payment_method($db);


# Read all reservations
$result = $payment_method->read();
$num = $result->rowCount();

if ($num > 0) {
    $payment = [
        'code' => 1,
        'status' => 200,
        'msg' => "Get All Payment Successfully!",
    ];

    $payment['data'] = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data = [
            'id' => $id,
            'method' => $method,
            'status' => $status,
            'image' => $image,
            'created_at' => $created_at,
        ];
        array_push($payment['data'], $data);
    }
    header("HTTP/0.1 200 OK");
    echo json_encode($payment, JSON_PRETTY_PRINT);

} else {
    $payment = [
        'code' => 0,
        'status' => 404,
        'msg' => "Get All Paymnents Unsuccessfully!",
        'data' => null
    ];
    header("HTTP/0.1 404 User Not Found");
    echo json_encode($payment, JSON_PRETTY_PRINT);
}


?>