<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotek');

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => [
            'kode' => '',
            'nama' => '',
            'kode_kategori' => '',
            'gambar' => '',
            'harga' => '',
        ]
    ]
];

if (!$koneksi) {
    $response['status'] = 400;
    $response['msg'] = "data gagal diperbarui";
} else {

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kode_kategori = $_POST['kode_kategori'];
    $harga = $_POST['harga'];

    if ($_FILES["gambar"]["name"] != "") {
        $result = mysqli_query($koneksi, "SELECT gambar FROM menu WHERE kode = '$kode'");
        $data = mysqli_fetch_assoc($result);
        $gambar = $data['gambar'];
        unlink($gambar);

        $temp = explode(".", $_FILES["gambar"]["name"]);
        $nama_gambar = md5(date('dmy h:i:s')) . '.' . end($temp);
        $target_file = "upload/" . $nama_gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
        $response['body']['data']['gambar'] = 'upload/' . $nama_gambar;
        mysqli_query($koneksi, "UPDATE menu SET gambar = 'upload/$nama_gambar' WHERE kode = '$kode'");
    }

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diperbarui';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['gambar'] = 'upload/' . $nama_gambar;
    $response['body']['data']['harga'] = $harga;

    mysqli_query($koneksi, "UPDATE menu 
    SET kode = '$kode', nama = '$nama', kode_kategori = '$kode_kategori', 'upload/$nama_gambar', harga = '$harga' WHERE kode = '$kode'");
}

echo json_encode($response);
