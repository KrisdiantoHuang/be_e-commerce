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

// Mengambil semua baris yang sesuai dari hasil queri
while ($row = mysqli_fetch_array($q)) {
  // Menambahkan data dari setiap baris ke dalam array
  $data = array(
    'nama_kategori' => $row['nama_kategori']
    // Tambahkan kolom lainnya sesuai kebutuhan
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
  $res['status'] = 401;
  $res['msg'] = "Data tidak ditemukan";
}

echo json_encode($res);