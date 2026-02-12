<?php
$conn = mysqli_connect("localhost", "root", "", "wsi");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* ================================
   1. Ambil Keyword Pencarian
================================ */
$keyword = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";

/* ================================
   2. Setup Pagination
================================ */
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$start = ($page - 1) * $limit;

/* ================================
   3. Hitung Total Data
================================ */
if ($keyword != "") {
    $count_sql = "
        SELECT COUNT(*) as total FROM mahasiswa 
        WHERE 
        nama LIKE '%$keyword%' OR
        nim LIKE '%$keyword%' OR
        prodi LIKE '%$keyword%' OR
        tanggal_lahir LIKE '%$keyword%' OR
        alamat LIKE '%$keyword%'
    ";
} else {
    $count_sql = "SELECT COUNT(*) as total FROM mahasiswa";
}

$count_result = mysqli_query($conn, $count_sql);
$total_data = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_data / $limit);

/* ================================
   4. Ambil Data Sesuai Search + Pagination
================================ */
if ($keyword != "") {
    $sql = "
        SELECT * FROM mahasiswa 
        WHERE 
        nama LIKE '%$keyword%' OR
        nim LIKE '%$keyword%' OR
        prodi LIKE '%$keyword%' OR
        tanggal_lahir LIKE '%$keyword%' OR
        alamat LIKE '%$keyword%'
        ORDER BY id DESC
        LIMIT $start, $limit
    ";
} else {
    $sql = "
        SELECT * FROM mahasiswa 
        ORDER BY id DESC
        LIMIT $start, $limit
    ";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <div class="card shadow p-4">

        <div class="d-flex justify-content-between mb-3">
            <h3>Data Mahasiswa</h3>
            <a href="form.php" class="btn btn-success">+ Tambah Data</a>
        </div>

        <!-- FORM SEARCH -->
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Cari nama, nim, prodi, tanggal lahir, alamat..."
                       value="<?= htmlspecialchars($keyword) ?>">
                <button class="btn btn-primary" type="submit">Cari</button>
                <a href="tabel.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <!-- TABEL DATA -->
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $no = $start + 1;
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['prodi']; ?></td>
                    <td><?= $row['tanggal_lahir']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Data tidak ditemukan</td></tr>";
            }
            ?>
            </tbody>
        </table>

        <!-- PAGINATION -->
        <?php if ($total_pages > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">

                <!-- Previous -->
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" 
                       href="?page=<?= $page - 1 ?>&search=<?= urlencode($keyword) ?>">
                        Previous
                    </a>
                </li>

                <!-- Nomor Halaman -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" 
                           href="?page=<?= $i ?>&search=<?= urlencode($keyword) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- Next -->
                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                    <a class="page-link" 
                       href="?page=<?= $page + 1 ?>&search=<?= urlencode($keyword) ?>">
                        Next
                    </a>
                </li>

            </ul>
        </nav>
        <?php endif; ?>

    </div>
</div>

</body>
</html>

