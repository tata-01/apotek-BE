<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_GET['kode'];
$query = mysqli_query($koneksi, "SELECT * FROM menu WHERE kode='$kode'");
    
    if ($query) {
        $menuData = mysqli_fetch_assoc($query);

        if ($menuData) {
            $response['status'] = 200;
            $response['msg'] = 'success';
            $response['body']['data'] = $menuData;
        } else {
            $response['status'] = 400;
            $response['msg'] = 'error';
        }
    }

echo json_encode($response);
?>
