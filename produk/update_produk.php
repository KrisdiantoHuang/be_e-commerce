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

$kode_brg = isset($_POST['kode_brg']) ? $_POST['kode_brg'] : '';
$nama_brg = isset($_POST['nama_brg']) ? $_POST['nama_brg'] : '';
$harga_brg = isset($_POST['harga_brg']) ? $_POST['harga_brg'] : '';
$nama_kategori = isset($_POST['nama_kategori']) ? $_POST['nama_kategori'] : '';
$stok_brg = isset($_POST['stok_brg']) ? $_POST['stok_brg'] : '';
$deskripsi_brg = isset($_POST['deskripsi_brg']) ? $_POST['deskripsi_brg'] : '';
$nama_gbr_baru = ''; // Initialize this variable

// Check if the file is uploaded
if (isset($_FILES['gambar_brg']['name']) && $_FILES['gambar_brg']['name'] != "") {
    $q = mysqli_query($conn, "SELECT gambar_brg FROM barang_tb WHERE kode_brg='$kode_brg'");
    $ary = mysqli_fetch_array($q);
    $gambar = isset($ary['gambar_brg']) ? $ary['gambar_brg'] : '';

    // Unlink only if the file exists and it is a file, not a directory
    $file_path = "gambar/" . $gambar;
    if ($gambar && file_exists($file_path) && is_file($file_path)) {
        unlink($file_path);
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
