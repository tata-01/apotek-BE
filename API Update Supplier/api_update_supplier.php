<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'data gagal diubah';
} else {
    $kode = $_POST['KODE'];
    $nama = $_POST['NAMA'];
    $alamat = $_POST['ALAMAT'];
    $no_telp = $_POST['NO_TELP'];

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diubah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['alamat'] = $alamat;
    $response['body']['data']['no_telp'] = $no_telp;

    mysqli_query($koneksi, "UPDATE supplier SET NAMA = '$nama', ALAMAT = '$alamat', NO_TELP = '$no_telp' WHERE KODE = '$kode'");
}

echo json_encode($response);
