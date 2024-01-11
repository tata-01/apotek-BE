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
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diubah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['alamat'] = $alamat;
    $response['body']['data']['no_telp'] = $no_telp;

    mysqli_query($koneksi, "UPDATE supplier SET nama = '$nama', alamat = '$alamat', no_telp = '$no_telp' WHERE KODE = '$kode'");
}

echo json_encode($response);
