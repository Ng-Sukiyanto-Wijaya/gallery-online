<?php
session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header("location: login-page.php");
    exit();
}

// Memeriksa apakah pengguna adalah admin atau pengguna biasa
$is_admin = isset($_SESSION['status']) && $_SESSION['status'] === 'admin';

// Import koneksi database
include "conn/koneksi.php";

// Fungsi untuk menghapus album
if ($is_admin && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['albumid'])) {
    $album_id = $_GET['albumid'];
    $sql_delete = "DELETE FROM album WHERE id = $album_id";
    if (mysqli_query($conn, $sql_delete)) {
        // Redirect kembali ke halaman album setelah menghapus
        header("Location: album.php");
        exit();
    } else {
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($conn);
    }
}

// Fungsi untuk menampilkan form edit album
if ($is_admin && isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['albumid'])) {
    $album_id = $_GET['albumid'];
    $sql_select = "SELECT * FROM album WHERE id = $album_id";
    $result = mysqli_query($conn, $sql_select);
    $album_data = mysqli_fetch_assoc($result);
    if (!$album_data) {
        echo "Album not found.";
        exit();
    }
}

// Fungsi untuk memproses form edit album
if ($is_admin && isset($_POST['edit_album'])) {
    $album_id = $_POST['album_id'];
    $nama_album = $_POST['nama_album_edit'];
    $sql_update = "UPDATE album SET namaalbum = '$nama_album' WHERE id = $album_id";
    if (mysqli_query($conn, $sql_update)) {
        // Redirect kembali ke halaman album setelah mengedit
        header("Location: album.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Navbarku -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>Gallery</b> Photo</a>
    <!-- Navbar Text -->
    <div class="w3-right w3-hide-small">
      <a href="index.php" class="w3-bar-item w3-button">Home</a>
      <a href="album.php" class="w3-bar-item w3-button">Album</a>
      <a href="<?php echo $is_admin ? 'halaman_admin.php' : 'foto.php'; ?>" class="w3-bar-item w3-button">Foto</a>
      <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>
  </div>
</div><br><br><br>
    <style>
/* CSS untuk daftar album */
ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    margin-bottom: 10px;
}

/* CSS untuk link edit dan hapus pada setiap item album */
ul li a {
    color: #007bff; /* warna default link */
    text-decoration: none;
    margin-left: 10px; /* jarak antara link */
}

ul li a:hover {
    text-decoration: underline; /* efek hover */
}

/* CSS untuk tombol hapus */
.delete-button {
    color: #dc3545; /* warna merah */
}

.delete-button:hover {
    text-decoration: underline; /* efek hover */
}

/* CSS untuk form edit album */
.edit-form {
    text-align: center;
    margin-top: 20px;
}

.edit-form label {
    display: block;
    margin-bottom: 10px;
}

.edit-form input[type="text"] {
    padding: 8px;
    border-radius: 3px;
    border: 1px solid #ccc;
    width: 200px;
    margin-bottom: 10px;
}

.edit-form input[type="submit"] {
    padding: 8px 20px;
    background-color: #007bff; /* warna biru */
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.edit-form input[type="submit"]:hover {
    background-color: #0056b3; /* warna biru gelap saat hover */
}
/* CSS untuk tabel */
table {
    width: 100%;
    border-collapse: collapse;
}

/* Warna latar belakang dan warna teks untuk header tabel */
th {
    background-color: #007bff; /* warna biru */
    color: #fff; /* warna teks putih */
    padding: 10px;
    text-align: left;
}

/* Warna latar belakang setiap baris selain header */
td {
    background-color: #f8f9fa; /* warna biru muda */
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd; /* garis bawah setiap baris */
}

/* Warna latar belakang setiap baris selain header saat dihover */
tr:hover td {
    background-color: #dcdcdc; /* warna abu-abu */
}


    </style>
</head>

<body>

    <h1>Halaman Album</h1>

    <?php if ($is_admin) : ?>
        <!-- Form untuk menambah album hanya ditampilkan jika pengguna adalah admin -->
        <form action="tambah_album.php" method="post">
            <label for="nama_album">Nama Album:</label>
            <input type="text" id="namaalbum" name="nama_album" required><br><br>
            <input type="submit" value="Tambah Album"><br><br>
        </form>
    <?php endif; ?>
<!-- Tampilkan daftar album yang sudah ada -->
<table>
    <thead>
        <tr>
            <th>Judul Album</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM album");
        while ($data = mysqli_fetch_array($sql)) :
        ?>
            <tr>
                <td><?= $data['namaalbum'] ?></td>
                <?php if ($is_admin) : ?>
                    <!-- Kolom aksi hanya ditampilkan untuk admin -->
                    <td>
    <a href="edit_album.php?albumid=<?= $data['albumid'] ?>" class="btn btn-primary">Edit</a>
    <a href="hapus_album.php?albumid=<?= $data['albumid'] ?>" onclick="return confirm('Are you sure you want to delete this album?')" class="btn btn-primary">Delete</a>
</td>

                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


    <?php if ($is_admin && isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['albumid'])) : ?>
    <!-- Form edit album hanya ditampilkan jika admin sedang dalam mode edit -->
    <?php if (!empty($album_data) && isset($album_data['id'])) : ?>
        <form action="" method="post">
            <input type="hidden" name="album_id" value="<?= $album_data['id'] ?>">
            <label for="nama_album_edit">Nama Album:</label>
            <input type="text" id="nama_album_edit" name="nama_album_edit" value="<?= $album_data['namaalbum'] ?>" required>
            <input type="submit" name="edit_album" value="Edit Album">
        </form>
    <?php else: ?>
        <p>Album not found or invalid request.</p>
    <?php endif; ?>
<?php endif; ?> 

</body>

</html>
