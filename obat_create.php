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
    $kode_kategori = $_POST['kode_kategori'];
    $kode_supplier = $_POST['kode_supplier'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];
    $desk = $_POST['desk'];

// cek duplikat
$query = mysqli_query($koneksi, "SELECT * FROM obat WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if($row == 1){

    $response['status'] = 400;
    $response['msg'] = 'data sudah ada';
} else {

    $temp = explode(".", $_FILES["gambar"]["name"]);
    $namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
    $target_file = "upload/" . $namaGambarBaru;
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

    $response['status'] = 200;
    $response['msg'] = 'data berhasil ditambah';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['gambar'] = 'upload/'.$namaGambarBaru;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['kode_supplier'] = $kode_supplier;
    $response['body']['data']['stock'] = $stock;
    $response['body']['data']['harga'] = $harga;
    $response['body']['data']['desk'] = $desk;
    mysqli_query($koneksi, "INSERT INTO obat (kode, nama, gambar, kode_kategori, kode_supplier, stock, harga, desk) VALUES ('$kode', '$nama', 'upload/$namaGambarBaru', '$kode_kategori', '$kode_supplier','$stock', '$harga', '$desk')");
}

echo json_encode($response);