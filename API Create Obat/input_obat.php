<?php
$conn = mysqli_connect('localhost', 'root', '', 'apotek');

$res = [
  "status" => 200,
  "msg" => "",
  "body" => [
    "data" => [
      "kode" => "",
      "nama" => "",
      "kode_kategori" => "",
      "gambar" => "",
      "harga" => "",
    ]
  ]
];

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$kode_kategori = $_POST['kode_kategori'];
$gambar = $_POST['gambar'];
$harga = $_POST['harga'];
$q = mysqli_query($conn, "INSERT INTO menu (kode,nama,kode_kategori,gambar,harga) VALUES ('$kode','$nama','$kode_kategori','$gambar','$harga')");

if ($q) {

  $res['status'] = 200;
  $res['msg'] = "Data berhasil di insert";
  $res['body']['data'] = [
    'kode' => $kode,
    'nama' => $nama,
    'kode_kategori' => $kode_kategori,
    'gambar' => $gambar,
    'harga' => $harga

  ];
} else {
  $res['status'] = 400;
  $res['msg'] = "Proses insert gagal";
  $res['body']['error'] = "";
}

echo json_encode($res);
