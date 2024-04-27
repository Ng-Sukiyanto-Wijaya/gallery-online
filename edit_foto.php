<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login-page.php");
    exit; // Keluar dari skrip jika sesi tidak ada
}

include "conn/koneksi.php";

// Ambil ID foto yang akan diedit
$fotoid = $_GET['fotoid'];

// Ambil data foto dari database berdasarkan ID
$sql = mysqli_query($conn, "SELECT * FROM foto WHERE fotoid='$fotoid'");
$data = mysqli_fetch_assoc($sql);

// Ambil daftar album untuk pilihan dropdown
$sql_album = mysqli_query($conn, "SELECT * FROM album WHERE userid='{$_SESSION['userid']}'");

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah pengguna memilih untuk mengunggah gambar baru
    if (isset($_FILES['lokasifile']['name']) && !empty($_FILES['lokasifile']['name'])) {
        // Ambil nama file yang diunggah
        $file_name = $_FILES['lokasifile']['name'];
        // Lokasi sementara file yang diunggah
        $file_tmp = $_FILES['lokasifile']['tmp_name'];

        // Pindahkan file ke direktori yang diinginkan (misalnya: folder 'gambar' di server Anda)
        move_uploaded_file($file_tmp, "gambar/$file_name");

        // Update lokasi file foto di database
        $query = "UPDATE foto SET lokasifile='$file_name' WHERE fotoid='$fotoid'";
        mysqli_query($conn, $query);
    }

    // Periksa apakah pengguna memilih untuk mengubah album
    if (isset($_POST['albumid']) && !empty($_POST['albumid'])) {
        // Ambil album yang dipilih
        $albumid = $_POST['albumid'];

        // Update album foto di database
        $query = "UPDATE foto SET albumid='$albumid' WHERE fotoid='$fotoid'";
        mysqli_query($conn, $query);
    }

    // Periksa apakah pengguna memilih untuk mengubah judul
    if (isset($_POST['judulfoto']) && !empty(trim($_POST['judulfoto']))) {
        // Ambil judul yang diinputkan
        $judulfoto = $_POST['judulfoto'];

        // Update judul foto di database
        $query = "UPDATE foto SET judulfoto='$judulfoto' WHERE fotoid='$fotoid'";
        mysqli_query($conn, $query);
    }
    // Periksa apakah pengguna memilih untuk mengubah deskripsi
    if (isset($_POST['deskripsifoto']) && !empty(trim($_POST['deskripsifoto']))) {
        // Ambil deskripsi yang diinputkan
        $deskripsifoto = $_POST['deskripsifoto'];

        // Update deskripsi foto di database
        $query = "UPDATE foto SET deskripsifoto='$deskripsifoto' WHERE fotoid='$fotoid'";
        mysqli_query($conn, $query);
    }

    // Redirect ke halaman foto setelah berhasil mengedit
    header("location:foto.php");
    exit; // Keluar dari skrip setelah mengalihkan
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto</title>
</head>
<body>
    <style>body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

input[type="file"], select, input[type="text"], input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

select {
    appearance: none; /* Remove default arrow */
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M10 12l-8-8H2l8 8 8-8h-1.1L10 12z' fill='%232d3748'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 20px;
    cursor: pointer;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

input[type="file"] {
    padding: 10px;
}

input[type="file"]:focus {
    outline: none;
}

/* Styling for error messages */
.error-message {
    color: #dc3545;
    margin-top: 5px;
    font-size: 14px;
}
</style>
    <h1>Edit Foto</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Form untuk mengunggah gambar baru -->
        <label for="lokasifile">Gambar Baru:</label><br>
        <input type="file" id="lokasifile" name="lokasifile"><br><br>

        <!-- Form untuk memilih album baru -->
        <label for="albumid">Album Baru:</label><br>
        <select name="albumid" id="albumid">
            <?php while ($album = mysqli_fetch_assoc($sql_album)) : ?>
                <option value="<?= $album['albumid'] ?>" <?= $album['albumid'] == $data['albumid'] ? 'selected' : '' ?>><?= $album['namaalbum'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <!-- Form untuk mengubah judul -->
        <label for="judulfoto">Judul Baru:</label><br>
        <input type="text" id="judulfoto" name="judulfoto" value="<?= $data['judulfoto'] ?>"><br><br>

        <!-- Form untuk mengubah deskripsi -->
        <label for="deskripsifoto">Deskripsi Baru:</label><br>
        <input type="text" id="deskripsifoto" name="deskripsifoto" value="<?= $data['deskripsifoto'] ?>"><br><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
</body>
</html>
