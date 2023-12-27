<?php
$conn = mysqli_connect('localhost', 'root', '', 'apotek');
$res = [
  "status" => 200,
  "msg" => "",
  "body" => [
      "data" => [
          "nama_kategori" => "",
      ]
  ]
      ];

$kode = $_POST['KODE'];
$nama = $_POST['NAMA'];
$q = mysqli_query($conn, "INSERT INTO kategori (KODE,NAMA) VALUES ('$kode','$nama')");

if ($q) {

  $res['status'] = 200;
  $res['msg'] = "Data berhasil di insert";
  $res['body']['data']=[
    'KODE' => $kode,
    'NAMA' => $nama
    ];
} else {
  $res['status'] = 400;
  $res['msg'] = "Gagal membuat kategori";
  $res['body']['error'] = "Kesalahan validasi input";
}

echo json_encode($res);
?>
