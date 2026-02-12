<?php

// Jumlah data halaman
$limit = 3;

// halaman sekarang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Hitung total data dari database
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa");
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Hitung offset
$start = ($page - 1) * $limit;
?>


