<?php
$conn = mysqli_connect('localhost', 'root', '', 'apotek');

$res = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_GET['kode'];

if (!isset($conn)) {

    $rese['status'] = 400;
    $res['msg'] = 'error';
} else {

    $result = mysqli_query($conn, "SELECT * FROM kategori WHERE kode = '$kode'");
    $row = mysqli_fetch_assoc($result);

    $res['status'] = 200;
    $res['msg'] = 'success';
    $res['body']['data'] = $row;
}

echo json_encode($res);
