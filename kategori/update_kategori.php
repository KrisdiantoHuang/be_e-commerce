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

$id_kategori = $_GET['id_kategori'];
// $id_kategori = $_POST['id_kategori'];
$nama_kategori = $_POST['nama_kategori'];

$q = mysqli_query($conn, "SELECT * FROM kategori_tb WHERE id_kategori='$id_kategori'");
$ary = mysqli_fetch_array($q);

// Gunakan prepared statements untuk mencegah SQL injection
$stmt = $conn->prepare("UPDATE kategori_tb SET nama_kategori = ? WHERE id_kategori = ?");
$stmt->bind_param("si", $nama_kategori, $id_kategori);

if ($stmt->execute()) {
  $res['msg'] = "Data berhasil diupdate";
  $res['body']['data']['nama_kategori'] = $nama_kategori;
} else {
  $res['status'] = 404;
  $res['msg'] = "Gagal mengupdate kategori";
  $res['body']['error'] = "Kesalahan validasi input";
}

$stmt->close();
$conn->close();

echo json_encode($res);
?>