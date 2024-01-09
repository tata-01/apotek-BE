<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_POST['kode'];
$nama = $_POST['nama'];



if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'data gagal dihapus';
    $response['body']['data']['KODE'] = $kode;
} else {

    mysqli_query($koneksi, "DELETE FROM kategori WHERE KODE = '$kode'");
    $response['status'] = 200;
    $response['msg'] = 'data berhasil dihapus';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;

}


echo json_encode($response);
