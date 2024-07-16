<?php
require_once 'function.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM kendaraan WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $data = mysqli_fetch_assoc($result);
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Data tidak ditemukan']);
}
