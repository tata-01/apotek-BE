<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_GET['kode'];

if(!isset($koneksi)){

    $response['status'] = 400;
    $response['msg'] = 'error';
}else{
    
    $query = "  SELECT obat.*, kategori.nama as nama_kategori, supplier.nama as nama_supplier
                FROM obat
                INNER JOIN kategori ON obat.kode_kategori = kategori.kode
                INNER JOIN supplier ON obat.kode_supplier = supplier.kode
                WHERE obat.kode = '$kode'
    ";

    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $response['status'] = 200;
    $response['msg'] = 'success';
    $response['body']['data'] = $row;
}

echo json_encode($response);