<?php
$conn = mysqli_connect("localhost", "root", "", "wsi");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama   = $_POST['nama'];
    $nim    = $_POST['nim'];
    $prodi  = $_POST['prodi'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO mahasiswa (nama, nim, prodi, tanggal_lahir, alamat)
              VALUES ('$nama', '$nim', '$prodi', '$tanggal_lahir', '$alamat')";

    mysqli_query($conn, $query);

    header("Location: tabel.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Input Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3>Form Input Data Mahasiswa</h3>

        <form method="POST">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>NIM</label>
                <input type="text" name="nim" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Program Studi</label>
                <select name="prodi" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option>Teknik Informatika</option>
                    <option>Sistem Informasi</option>
                    <option>Manajemen Informatika</option>
                    <option>Teknik Komputer</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="tabel.php" class="btn btn-secondary">Lihat Data</a>
        </form>
    </div>
</div>

</body>
</html>
