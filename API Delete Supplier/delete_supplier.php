<?php
include "env.php";

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_POST['KODE'];
$nama = $_POST['NAMA'];
$alamat = $_POST['ALAMAT'];
$no_handphone = $_POST['NO_HANDPHONE'];


if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'data gagal dihapus';
    $response['body']['data']['KODE'] = $kode;
} else {

    mysqli_query($koneksi, "DELETE FROM supplier WHERE KODE = '$kode'");
    $response['status'] = 200;
    $response['msg'] = 'data berhasil dihapus';
    $response['body']['data']['KODE'] = $kode;
    $response['body']['data']['NAMA'] = $nama;
    $response['body']['data']['ALAMAT'] = $alamat;
    $response['body']['data']['NO_HANDPHONE'] = $no_handphone;
}


echo json_encode($response);
