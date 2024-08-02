<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";

$reservation = new Reservation($db);
$result = $reservation->readLimt();

if ($result->rowCount() > 0) {

    $response = [
        'code' => 1,
        'status' => 200,
        'msg' => "All reservations have been shown!",
        'data' => []
    ];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $data = [
            'id' => $id,
            'name' => $name,
            'phone' => $phone,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'adults' => $adult,
            'children' => $children,
            'status' => $status,
            'category_id' => $category_id,
            'price' => $price,
            'payment_id' => $payment_id,
            'created_at' => $created_at,
        ];
        array_push($response['data'], $data);
    }
    echo json_encode($response, JSON_PRETTY_PRINT);

} else {
    $response = [
        'code' => 0,
        'status' => 404,
        'msg' => "No reservations found!",
        'data' => []
    ];
    echo json_encode($response, JSON_PRETTY_PRINT);
}


?>