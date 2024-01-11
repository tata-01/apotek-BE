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
$alamat = $_POST['alamat'];
$no_handphone = $_POST['no_telp'];



$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if ($row == 1) {

    $response['status'] = 400;
    $response['msg'] = 'data sudah ada';
} else {

    $response['status'] = 200;
    $response['msg'] = 'Data Berhasil Diinput';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['alamat'] = $alamat;
    $response['body']['data']['no_telp'] = $no_handphone;


    mysqli_query($koneksi, "INSERT INTO supplier (kode, nama,alamat,no_telp) VALUES ('$kode', '$nama','$alamat','$no_handphone')");
}

echo json_encode($response);
