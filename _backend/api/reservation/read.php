<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/init.php";

$reservation = new Reservation($db);


# Read all reservations
$result = $reservation->read();
$num = $result->rowCount();

if ($num > 0) {
    $reservations = [
        'code' => 1,
        'status' => 200,
        'msg' => "Get All Reservations Successfully!",
    ];

    $reservations['data'] = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data = [
            'id' => $id,
            'name' => $name,
            'phone' => $phone,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'adult' => $adult,
            'children' => $children,
            'status' => $status,
            'category_id' => $category_id,
            'price' => $price,
            'payment_id' => $payment_id,
            'created_at' => $created_at,
        ];
        array_push($reservations['data'], $data);
    }
    header("HTTP/0.1 200 OK");
    echo json_encode($reservations, JSON_PRETTY_PRINT);

} else {
    $reservations = [
        'code' => 0,
        'status' => 404,
        'msg' => "Get All Reservations Unsuccessfully!",
        'data' => null
    ];
    header("HTTP/0.1 404 User Not Found");
    echo json_encode($reservations, JSON_PRETTY_PRINT);
}


?>