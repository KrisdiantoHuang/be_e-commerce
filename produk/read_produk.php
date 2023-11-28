<?php
include "../env.php";

$res = [
  "status" => 200,
  "msg" => "",
  "body" => [
    "data" => [
      [
        "gambar_brg" => "",
        "kode_brg" => "",
        "nama_brg" => "",
        "harga_brg" => "",
        "id_kategori" => "",
        "stok_brg" => "",
        "deskripsi_brg" => "",
      ]
    ]
  ]
];

$q = mysqli_query($conn, "SELECT * FROM barang_tb");

// Inisialisasi array untuk menyimpan data
$dataArray = array();

// Mengambil semua baris yang sesuai dari hasil queri
while ($row = mysqli_fetch_array($q)) {
  // Menambahkan data dari setiap baris ke dalam array
  $data = array(
    'gambar_brg' => $row['gambar_brg'],
    'kode_brg' => $row['kode_brg'],
    'nama_brg' => $row['nama_brg'],
    'harga_brg' => $row['harga_brg'],
    'id_kategori' => $row['id_kategori'],
    'stok_brg' => $row['stok_brg'],
    'deskripsi_brg' => $row['deskripsi_brg'],
    
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