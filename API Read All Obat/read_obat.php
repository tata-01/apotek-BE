<?php
$conn = mysqli_connect('localhost', 'root', '', 'apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

if (!isset($conn)) {

    $response['status'] = 400;
    $response['msg'] = 'error';
} else {

    $result = mysqli_query($conn, "SELECT * FROM menu");
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $response['status'] = 200;
    $response['msg'] = 'success';
    $response['body']['data'] = $row;
}

echo json_encode($response);
?>