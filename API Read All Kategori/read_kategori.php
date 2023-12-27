<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'apotek');

$res = [
    "status" => "200",
    "msg" => "data berhasil dibaca",
    "body" => [
        "data" => [],
    ],
];

// Check if an ID is provided
if (isset($_GET['id'])) {
   $kode = $_GET['id'];

    $stmt = $koneksi->prepare("SELECT * FROM kategori WHERE kode = ?");
    $stmt->bind_param("i",$kode);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $res['body']['data'] = $row;
    } else {
        $res['status'] = 400;
        $res['msg'] = "Data tidak ditemukan";
    }

    $stmt->close();
} else {
    // Fetch all categories if no ID is provided
    $q = mysqli_query($koneksi, "SELECT * FROM kategori");

    // Inisialisasi array untuk menyimpan data
    $dataArray = array();

    while ($row = mysqli_fetch_array($q)) {
        $data = array(
            'KODE' => $row['KODE'],
            'NAMA' => $row['NAMA'],
        );
        $dataArray[] = $data;
    }

    if (!empty($dataArray)) {
        $res['body']['data'] = $dataArray;
    } else {
        $res['status'] = 400;
        $res['msg'] = "Data tidak ditemukan";
    }
}

echo json_encode($res);
?>
