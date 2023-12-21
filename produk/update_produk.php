<?php
include "../env.php";

$res = [
    "status" => 200,
    "msg" => "",
    "body" => [
        "data" => [
            "kode_brg" => "",
            "nama_brg" => "",
            "harga_brg" => "",
            "nama_kategori" => "",
            "stok_brg" => "",
            "deskripsi_brg" => "",
            "gambar_brg" => ""
        ]
    ]
];

$kode_brg = $_POST['kode_brg'];
$nama_brg = $_POST['nama_brg'];
$harga_brg = $_POST['harga_brg'];
$nama_kategori = $_POST['nama_kategori'];
$stok_brg = $_POST['stok_brg'];
$deskripsi_brg = $_POST['deskripsi_brg'];

// Check if the file is uploaded
if (isset($_FILES['gambar_brg']['name']) && $_FILES['gambar_brg']['name'] != "") {
    $q = mysqli_query($conn, "SELECT gambar_brg FROM barang_tb WHERE kode_brg='$kode_brg'");
    $ary = mysqli_fetch_array($q);
    $gambar = $ary['gambar_brg'];

    // Unlink only if the file exists
    if (file_exists("gambar/" . $gambar)) {
        unlink("gambar/" . $gambar);
    }

    $nama_gbr_baru = basename($_FILES["gambar_brg"]["name"]);
    $target_file = "gambar/" . basename($_FILES["gambar_brg"]["name"]);
    $upload = move_uploaded_file($_FILES["gambar_brg"]["tmp_name"], $target_file);

    // Update the database with the new image name
    mysqli_query($conn, "UPDATE barang_tb SET gambar_brg='$nama_gbr_baru' WHERE kode_brg='$kode_brg'");
}

// Update other fields
$query = "UPDATE barang_tb SET nama_brg='$nama_brg', harga_brg='$harga_brg', nama_kategori='$nama_kategori',
stok_brg='$stok_brg', deskripsi_brg='$deskripsi_brg' WHERE kode_brg='$kode_brg'";

$result = mysqli_query($conn, $query);

if ($result) {
    $res['status'] = 200;
    $res['msg'] = "Data berhasil diupdate";
    $res['body']['data'] = [
        'gambar_brg' => $nama_gbr_baru,
        'kode_brg' => $kode_brg,
        'nama_brg' => $nama_brg,
        'harga_brg' => $harga_brg,
        'nama_kategori' => $nama_kategori,
        'stok_brg' => $stok_brg,
        'deskripsi_brg' => $deskripsi_brg,
    ];
} else {
    $res['status'] = 401;
    $res['msg'] = "Gagal mengupdate data";
    $res['body']['error'] = "Kesalahan validasi input";
}

echo json_encode($res);
