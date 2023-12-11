<?php
include "../env.php";

$res = [
  "status" => 200,
  "msg" => "",
  "body" => [
      "data" => [
          "gambar_brg" => "",
          "kode_brg" => "",
          "nama_brg" => "",
          "harga_brg" => "",
          "id_kategori" => "",
          "stok_brg" => "",
          "deskripsi_brg" => "",
      ]
  ]
      ];

      // Mengambil informasi file gambar
$gambar_brg = $_FILES["gambar_brg"]["name"];
$gambar_tmp = $_FILES["gambar_brg"]["tmp_name"];
$gambar_path = "gambar/" . $gambar_brg;  // Sesuaikan dengan direktori upload Anda
// Pindahkan file gambar ke direktori upload
move_uploaded_file($gambar_tmp, $gambar_path);


// $gambar_brg = basename($_FILES["gambar_brg"]["name"]);
// $target_file = "/gambar". basename($_FILES["gambar_brg"]["name"]);
// $upload = move_uploaded_file($_FILES["gambar_brg"]["tmp_name"], $target_file);

// $gambar_brg=$_POST['gambar_brg'];
$kode_brg = $_GET['kode_brg'];
$nama_brg = $_POST['nama_brg'];
$harga_brg = $_POST['harga_brg'];
$id_kategori = $_POST['id_kategori'];
$stok_brg = $_POST['stok_brg'];
$deskripsi_brg = $_POST['deskripsi_brg'];

$i=mysqli_query($conn, "SELECT * FROM kategori_tb");

while ($row = mysqli_fetch_array($i)) {

   $row['nama_kategori'];

}


$q= "UPDATE barang_tb SET gambar_brg='$gambar_brg', nama_brg='$nama_brg', id_kategori='$id_kategori',
harga_brg='$harga_brg',stok_brg='$stok_brg',deskripsi_brg ='$deskripsi_brg'  WHERE kode_brg='$kode_brg'";
// $q="INSERT INTO barang_tb (gambar_brg,kode_brg,nama_brg,harga_brg,id_kategori,stok_brg,deskripsi_brg) 
// VALUES ('$gambar_brg','$kode_brg','$nama_brg','$harga_brg','$id_kategori','$stok_brg','$deskripsi_brg')";


$result=mysqli_query($conn,$q);
                                                                      
if ($result) {

  $res['status'] = 200;
  $res['msg'] = "Data berhasil di update";
  $res['body']['data'] =[
  'gambar_brg' => $gambar_brg,
  'kode_brg' => $kode_brg,
  'nama_brg' => $nama_brg,
  'harga_brg' => $harga_brg,
  'id_kategori' => $id_kategori,
  'stok_brg' => $stok_brg,
  'deskripsi_brg' => $deskripsi_brg,
  
  ];
 
} else {
  $res['status'] = 401;
  $res['msg'] = "Gagal update barang";
  $res['body']['error'] = "Kesalahan validasi input";
}

echo json_encode($res);
?>
