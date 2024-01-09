<?php
include "env.php";

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$alamat = $_POST['ALAMAT'];
$no_handphone = $_POST['no_telp'];


if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'data gagal dihapus';
    $response['body']['data']['kode'] = $kode;
} else {

    mysqli_query($koneksi, "DELETE FROM supplier WHERE kode = '$kode'");
    $response['status'] = 200;
    $response['msg'] = 'data berhasil dihapus';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['alamat'] = $alamat;
    $response['body']['data']['no_telp'] = $no_handphone;
}


echo json_encode($response);
