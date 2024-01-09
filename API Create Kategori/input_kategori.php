<?php
$conn= mysqli_connect('localhost','root','','apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_POST['kode'];
$nama = $_POST['nama'];

// cek duplikat
$query = mysqli_query($conn, "SELECT * FROM kategori WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if($row == 1){

    $response['status'] = 400;
    $response['msg'] = 'gagal membuat kategori';
} else {

    $response['status'] = 200;
    $response['msg'] = 'data berhasil  diinsert';
    $response['body']['data']['kode']= $kode;
    $response['body']['data']['nama'] = $nama;
    
    mysqli_query($conn, "INSERT INTO kategori (kode, nama) VALUES ('$kode', '$nama')");
}

echo json_encode($response);