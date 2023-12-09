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

$q = mysqli_query($conn, "SELECT * FROM kategori_tb");
while ($row = mysqli_fetch_array($q)) {

  $row['nama_kategori'];

}

$query = "UPDATE kategori_tb SET nama_kategori='$nama_kategori' where id_kategori='$id_kategori' ";
$result=mysqli_query($conn,$query);
if ($result) {
  $res['msg'] = "Data berhasil diupdate";
  $res['body']['data']['nama_kategori'] = $nama_kategori;
} else {
  $res['status'] = 404;
  $res['msg'] = "Gagal mengupdate kategori";
  $res['body']['error'] = "Kesalahan validasi input";
}



echo json_encode($res);
?>
