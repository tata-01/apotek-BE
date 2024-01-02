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



$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE KODE = '$kode'");
$row = mysqli_num_rows($query);

if ($row == 1) {

    $response['status'] = 400;
    $response['msg'] = 'data sudah ada';
} else {

    $response['status'] = 200;
    $response['msg'] = 'Data Berhasil Diinput';
    $response['body']['data']['KODE'] = $kode;
    $response['body']['data']['NAMA'] = $nama;
    $response['body']['data']['ALAMAT'] = $alamat;
    $response['body']['data']['NO_HANDPHONE'] = $no_handphone;


    mysqli_query($koneksi, "INSERT INTO supplier (KODE, NAMA,ALAMAT,NO_HANDPHONE) VALUES ('$kode', '$nama','$alamat','$no_handphone')");
}

echo json_encode($response);
