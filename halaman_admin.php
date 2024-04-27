<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'admin') {
    header("location: halaman_admin.php");
    exit();
}

// Import koneksi database
include "conn/koneksi.php";

// Jika terdapat request untuk menghapus foto
if (isset($_POST['hapus_foto'])) {
    $id_foto = $_POST['id_foto'];
    $path_to_image = $_POST['path_to_image'];

    // Mengambil ID foto yang ingin dihapus dari formulir yang dikirimkan
$id_foto = $_POST['id_foto'];

// Perintah SQL untuk menghapus baris dengan ID tertentu dari tabel foto
$sql_delete = "DELETE FROM foto WHERE fotoid = $id_foto";

// Menjalankan perintah SQL
if (mysqli_query($conn, $sql_delete)) {
    echo "Foto berhasil dihapus.";
} else {
    echo "Error: " . $sql_delete . "<br>" . mysqli_error($conn);
}
    } else {
        echo "Gagal menghapus foto.";
    }

// Query untuk mendapatkan daftar foto yang diupload oleh pengguna
$sql = "SELECT foto.fotoid, foto.judulfoto, foto.lokasifile, user.username 
        FROM foto 
        INNER JOIN user ON foto.userid = user.userid";
$result = mysqli_query($conn, $sql);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Admin Page</title> 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script>
        function showSuccessMessage() {
            alert("Foto berhasil dihapus.");
        }
    </script>
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- Navbarku -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>Gallery</b> Photo</a>
    <!-- Navbar Text -->
    <div class="w3-right w3-hide-small">
      <a href="index.php" class="w3-bar-item w3-button">Home</a>
      <a href="album.php" class="w3-bar-item w3-button">Album</a>
      <a href="halaman_admin.php" class="w3-bar-item w3-button">Foto</a>
      <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>
  </div>
</div>
    <style>
        /* Reset CSS */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }

        img {
            display: block;
            margin: 0 auto;
            width: 100%;
            max-width: 200px;
            height: auto;
        }

        form {
            text-align: center;
        }

        input[type="submit"] {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Gaya untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #f2f9ff; /* Warna latar belakang tabel */
        }

        th,
        td {
            padding: 12px; /* Ubah padding menjadi 12px */
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: top; /* Tetapkan tata letak vertikal ke atas */
        }

        th {
            background-color: #007bff; /* Warna latar belakang header kolom */
            color: white; /* Warna teks header kolom */
        }

        tr:hover {
            background-color: #cce5ff; /* Warna latar belakang saat dihover */
        }

        /* Atur lebar kolom agar tetap */
        table th:nth-child(2),
        table td:nth-child(2) {
            width: 200px; /* Sesuaikan lebar kolom gambar */
        }

        table th:nth-child(3),
        table td:nth-child(3) {
            width: 150px; /* Sesuaikan lebar kolom uplouder */
        }

        table th:nth-child(4),
        table td:nth-child(4) {
            width: 80px; /* Sesuaikan lebar kolom aksi */
            text-align: center; /* Pusatkan teks pada kolom aksi */
        }

        /* Gaya untuk gambar */
        .gambar-container {
            display: flex;
            justify-content: center;
        }

        .gambar-container img {
            max-width: 150px;
            border: 1px solid #ddd; /* Tambahkan garis pembatas */
            border-radius: 5px; /* Agar gambar memiliki sudut yang sedikit melengkung */
        }

    </style>

</head>

<body>
<br><br><br>
    <h1>Halaman Admin</h1>

    <!-- Tampilkan daftar foto yang diupload oleh pengguna -->
<!-- Tampilkan daftar foto yang diupload oleh pengguna -->
<h2>Foto yang Diunggah oleh Pengguna</h2>
<table>
    <thead>
        <tr>
            <th>Judul Foto</th>
            <th>Uplouder</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['judulfoto'] ?></td>
                <td><?= $row['username'] ?></td>
                <td class="gambar-container">
                    <img src="gambar/<?= $row['lokasifile'] ?>" alt="<?= $row['judulfoto'] ?>">
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id_foto" value="<?= $row['fotoid'] ?>">
                        <input type="hidden" name="path_to_image" value="<?= $row['lokasifile'] ?>">
                        <input type="submit" name="hapus_foto" value="Hapus" onclick="showSuccessMessage()">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


</body>

</html>
