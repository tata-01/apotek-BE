<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => [
            'kode' => '',
            'nama' => '',
            'kode_kategori' => '',
            'kode_supplier' => '',
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
    $kode_supplier = $_POST['kode_supplier'];
    $harga = $_POST['harga'];
    $desc = mysqli_real_escape_string($koneksi, $_POST['desc']);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES["gambar"]["name"] != "") {
        // ambil nama gambar lama
        $result = mysqli_query($koneksi, "SELECT gambar FROM obat WHERE kode = '$kode'");
        $data = mysqli_fetch_assoc($result);
        $gambar = $data['gambar'];

        // hapus gambar lama
        unlink($gambar);

        // upload gambar baru
        $temp = explode(".", $_FILES["gambar"]["name"]);
        $namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
        $target_file = "upload/" . $namaGambarBaru;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        $response['body']['data']['gambar'] = 'upload/' . $namaGambarBaru;
        mysqli_query($koneksi, "UPDATE obat SET gambar = 'upload/$namaGambarBaru' WHERE kode = '$kode'");
    }

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diperbarui';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['kode_supplier'] = $kode_supplier;
    $response['body']['data']['harga'] = $harga;
    $response['body']['data']['deskripsi'] = $desc;

    mysqli_query($koneksi, "UPDATE obat 
                            SET kode = '$kode', 
                                nama = '$nama', 
                                kode_kategori = '$kode_kategori',
                                kode_supplier = '$kode_supplier',
                                harga = '$harga',
                                deskripsi = '$desc'
                            WHERE kode = '$kode'");
}

echo json_encode($response);
