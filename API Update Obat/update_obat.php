<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => [
            'KODE' => '',
            'NAMA' => '',
            'KODE_KATEGORI' => '',
            'GAMBAR' => '',
            'HARGA' => '',
        ]
    ]
];

if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'data gagal diperbarui';
} else {

    $kode = $_POST['KODE'];
    $nama = $_POST['NAMA'];
    $kode_kategori = $_POST['KODE_KATEGORI'];
    $harga = $_POST['HARGA'];

    if ($_FILES["GAMBAR"]["name"] != "") {
        $query = mysqli_query($koneksi, "SELECT * FROM menu WHERE KODE = '$kode'");
        $row = mysqli_num_rows($query);

        $temp = explode(".", $_FILES["GAMBAR"]["name"]);
        $namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
        $target_file = "upload/" . $namaGambarBaru;
        move_uploaded_file($_FILES["GAMBAR"]["tmp_name"], $target_file);

        $response['body']['data']['GAMBAR'] = 'upload/' . $namaGambarBaru;
        mysqli_query($koneksi, "UPDATE menu SET GAMBAR = 'upload/$namaGambarBaru WHERE KODE = '$kode'");
    }

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diperbarui';
    $response['body']['data']['KODE'] = $kode;
    $response['body']['data']['NAMA'] = $nama;
    $response['body']['data']['GAMBAR'] = '' . $namaGambarBaru;
    $response['body']['data']['KODE_KATEGORI'] = $kode_kategori;
    $response['body']['data']['HARGA'] = $harga;

    mysqli_query($koneksi, "UPDATE menu 
    SET KODE = '$kode', 
        NAMA = '$nama', 
        KODE_KATEGORI = '$kode_kategori',
        HARGA = '$harga'
    WHERE KODE = '$kode'");
}

echo json_encode($response);
