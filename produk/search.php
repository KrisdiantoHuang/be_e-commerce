<?php
include "../env.php";

$res = [
    "status" => 200,
    "msg" => "",
    "body" => [
        "data" => []  
    ]
];

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function cari($keyword, $currentPage, $itemsPerPage) {
    global $conn;

    // Calculate the offset based on the current page and items per page
    $offset = ($currentPage - 1) * $itemsPerPage;

    $query = "SELECT * FROM barang_tb WHERE nama_brg LIKE ? LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $query);

    $keyword = '%' . $keyword . '%';

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sii", $keyword, $offset, $itemsPerPage);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Check for errors
    if (!$result) {
        // Handle the error, log it, and return an empty array or an error response
        error_log("Error in query: " . mysqli_error($conn));
        return [];
    }

    // Directly return the result
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if (isset($_GET["keyword"])) {
    // Set default values for pagination
    $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
    $itemsPerPage = 8; // Update to the desired number of items per page

    error_log("currentPage: " . $currentPage . ", itemsPerPage: " . $itemsPerPage);

    // Mendapatkan hasil pencarian dengan pagination
    $res["body"]["data"] = cari($_GET["keyword"], $currentPage, $itemsPerPage);
    echo json_encode($res);
}



?>
