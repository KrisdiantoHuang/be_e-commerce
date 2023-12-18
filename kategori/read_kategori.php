<?php
include "../env.php";

$res = [
    "status" => 200,
    "msg" => "",
    "body" => [
        "data" => [],
    ],
];

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id_kategori = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM kategori_tb WHERE id_kategori = ?");
    $stmt->bind_param("i", $id_kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $res['body']['data'] = $row;
    } else {
        $res['status'] = 401;
        $res['msg'] = "Data tidak ditemukan";
    }

    $stmt->close();
} else {
    // Fetch all categories if no ID is provided
    $q = mysqli_query($conn, "SELECT * FROM kategori_tb");

    // Inisialisasi array untuk menyimpan data
    $dataArray = array();

    while ($row = mysqli_fetch_array($q)) {
        $data = array(
            'id_kategori' => $row['id_kategori'],
            'nama_kategori' => $row['nama_kategori'],
        );
        $dataArray[] = $data;
    }

    if (!empty($dataArray)) {
        $res['body']['data'] = $dataArray;
    } else {
        $res['status'] = 401;
        $res['msg'] = "Data tidak ditemukan";
    }
}

echo json_encode($res);
?>
