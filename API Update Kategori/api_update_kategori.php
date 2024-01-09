<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => []
];

if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'data gagal diubah';
} else {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diubah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;

    mysqli_query($koneksi, "UPDATE kategori SET NAMA = '$nama' WHERE KODE = '$kode'");
}

echo json_encode($response);
