<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotik');

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_GET['KODE'];
$query = mysqli_query($koneksi, "SELECT * FROM menu WHERE KODE='$kode'");
    
    if ($query) {
        $menuData = mysqli_fetch_assoc($query);

        if ($menuData) {
            $response['status'] = 200;
            $response['msg'] = 'Berhasil';
            $response['body']['data'] = $menuData;
        } else {
            $response['status'] = 400;
            $response['msg'] = 'Gagal';
        }
    }

echo json_encode($response);
?>
