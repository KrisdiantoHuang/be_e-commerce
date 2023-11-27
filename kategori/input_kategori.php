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
$id_kategori = $_POST['id_kategori'];
$nama_kategori = $_POST['nama_kategori'];
$q = mysqli_query($conn, "INSERT INTO kategori_tb (id_kategori, nama_kategori) VALUES ('$id_kategori', '$nama_kategori')");

if ($q) {

  $res['status'] = 200;
  $res['msg'] = "Data berhasil di insert";
  $res['body']['data']['nama_kategori'] = $nama_kategori;
} else {
  $res['status'] = 401;
  $res['msg'] = "Gagal membuat kategori";
  $res['body']['error'] = "Kesalahan validasi input";
}

echo json_encode($res);
?>
