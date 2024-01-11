<?php
include 'env.php';
$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];
$kode = $_POST['kode'];
$nama = $_POST['nama'];

$query = mysqli_query($koneksi, "DELETE FROM kategori WHERE KODE = '$kode'");

if ($query) {
    $response['status'] = 200;
    $response['msg'] = 'Data berhasil diinsert';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
} else {
    $response['status'] = 400;
    $response['msg'] = 'Gagal membuat kategori';    
}

echo json_encode($response);
