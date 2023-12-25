<?php
$conn = mysqli_connect('localhost', 'root', '', 'apotek');

$res = [
  "status" => 200,
  "msg" => "",
  "body" => [
    "data" => [
      "kode" => "1",
      "nama" => "Panadol",
      "kode_kategori" => "1",
      "gambar" => "upload/gambar.jpg",
      "harga" => "20000",
    ]
  ]
];

$kode = $_POST['KODE'];
$nama = $_POST['NAMA'];
$kode_kategori = $_POST['KODE_KATEGORI'];
$gambar = $_POST['GAMBAR'];
$harga = $_POST['HARGA'];
$q = mysqli_query($conn, "INSERT INTO menu (KODE,NAMA,KODE_KATEGORI,GAMBAR,HARGA) VALUES ('$kode','$nama','$kode_kategori','$gambar','$harga')");

if ($q) {

  $res['status'] = 200;
  $res['msg'] = "Data berhasil di insert";
  $res['body']['data'] = [
    'KODE' => $kode,
    'NAMA' => $nama,
    'KODE_KATEGORI' => $kode_kategori,
    'GAMBAR' => $gambar,
    'HARGA' => $harga

  ];
} else {
  $res['status'] = 400;
  $res['msg'] = "Proses insert gagal";
  $res['body']['error'] = "Kesalahan validasi input";
}

echo json_encode($res);
