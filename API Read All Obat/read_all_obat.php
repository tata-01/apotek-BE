<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotek');


$res = [
  "status" => 200,
  "msg" => "",
  "body" => [
    "data" => [
      [
        "KODE" => "",
        "NAMA" => "",
        "KODE_KATEGORI" => "",
        "GAMBAR" => "",
        "HARGA" => ""        
      ]
    ]
  ]
];

$q = mysqli_query($koneksi, "SELECT * FROM menu");
// Inisialisasi array untuk menyimpan data
$dataArray = array();

// Mengambil semua baris yang sesuai dari hasil queri
while ($row = mysqli_fetch_array($q)) {
  // Menambahkan data dari setiap baris ke dalam array
  $data = array(
    'KODE' => $row['KODE'],
    'NAMA' => $row['NAMA'],
    'KODE_KATEGORI' => $row['KODE_KATEGORI'],
    'GAMBAR' => $row['GAMBAR'],
    'HARGA' => $row['HARGA']    
  );

  // Menambahkan data ke dalam array utama
  $dataArray[] = $data;
}

// Memeriksa apakah ada data yang ditemukan
if (!empty($dataArray)) {
  $res['status'] = 200;
  $res['msg'] = "Data berhasil diambil";
  $res['body']['data'] = $dataArray;
} else {
  $res['status'] = 400;
  $res['msg'] = "Data tidak ditemukan";
}

echo json_encode($res);