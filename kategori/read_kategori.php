<?php
include "../env.php";

$res = [
  "status" => 200,
  "msg" => "",
  "body" => [
    "data" => [
      "nama_kategori" => "",
    ]
  ]
];

$q = mysqli_query($conn, "SELECT * FROM kategori_tb");

// Inisialisasi array untuk menyimpan data
$dataArray = array();

while ($row = mysqli_fetch_array($q)) {
    $data = array(
        'id_kategori' => $row['id_kategori'],
        'nama_kategori' => $row['nama_kategori']
    );
    $dataArray[] = $data;
}

if (!empty($dataArray)) {
    $res['status'] = 200;
    $res['msg'] = "Data berhasil diambil";
    $res['body']['data'] = $dataArray;
} else {
    $res['status'] = 401;
    $res['msg'] = "Data tidak ditemukan";
}

echo json_encode($res);
