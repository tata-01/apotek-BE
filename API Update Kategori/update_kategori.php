<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'Apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => []
];

if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'data gagal diubah';
} else {
    $kode = $_POST['KODE'];
    $nama = $_POST['NAMA'];

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diubah';
    $response['body']['data']['KODE'] = $kode;
    $response['body']['data']['NAMA'] = $nama;

    mysqli_query($koneksi, "UPDATE kategori SET NAMA = '$nama' WHERE KODE = '$kode'");
}

echo json_encode($response);
