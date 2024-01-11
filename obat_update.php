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
            'stock' => '',
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
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];

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
    $response['msg'] = 'data berhasil diperbaharui';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['gambar'] = 'upload/'.$namaGambarBaru;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['kode_supplier'] = $kode_supplier;
    $response['body']['data']['stock'] = $stock;
    $response['body']['data']['harga'] = $harga;

    mysqli_query($koneksi, "UPDATE `obat` SET `kode`='$kode',`nama`='$nama',`kode_kategori`='$kode_kategori',`kode_supplier`='$kode_supplier',`stock`='$stock',`harga`='$harga' WHERE 1");
}

echo json_encode($response);
