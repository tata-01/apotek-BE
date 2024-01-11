<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => [
            'kode' => ''
        ]
    ]
];

$kode = $_POST['kode'];

if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'data gagal dihapus';
    $response['body']['data']['kode'] = $kode;
} else {

    $q = mysqli_query($koneksi,"SELECT gambar FROM obat WHERE kode='$kode'");
    $ary = mysqli_fetch_array($q);
    $file = $ary['gambar'];

    unlink($file);

    mysqli_query($koneksi, "DELETE FROM obat WHERE kode = '$kode'");
    $response['status'] = 200;
    $response['msg'] = 'data berhasil dihapus';
    $response['body']['data']['kode'] = $kode;
}
echo json_encode($response);