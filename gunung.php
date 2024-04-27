<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Gunung</title>
    <link rel="stylesheet" href="style.css">
    <!DOCTYPE html>
<html>
<head>
<title>Album Gunung</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Navbarku -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>Gallery</b> Photo</a>
    <!-- Navbar Text -->
    <div class="w3-right w3-hide-small">
      <a href="index.php" class="w3-bar-item w3-button">Home</a>
                <a href="album.php" class="w3-bar-item w3-button">Album</a>
      <a href="foto.php" class="w3-bar-item w3-button">Foto</a>
      <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>
  </div>
</div>
    <style>
               body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1500px;
            margin:  auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
            text-align: center;
            margin-bottom: 30px;
        }

        ul li {
            display: inline-block;
            margin-right: 10px;
        }

        .photo-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .photo-card {
            flex-basis: calc(25% - 20px);
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .photo-card:hover {
            transform: translateY(-5px);
        }

        .photo-card img {
            max-width: 100%;
            display: block;
            margin: 0 auto 20px;
            border-radius: 8px;
        }

        .photo-card h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #555;
        }

        .photo-card p {
            margin-bottom: 10px;
            color: #777;
            flex-grow: 1; /* Menyebarkan ruang di antara elemen teks */
        }

        .photo-card .actions {
            text-align: center;
            margin-top: 10px;
        }

        .photo-card .actions a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
            transition: color 0.3s ease;
        }

        .photo-card .actions a:hover {
            color: #0056b3;
        }

        @media screen and (max-width: 600px) {
            .container {
                width: 90%;
            }

            h1 {
                font-size: 24px;
            }

            .photo-card {
                flex-basis: calc(50% - 20px);
            }
        }   
    </style>   
    </style>
</head>
<body>
    <div class="container"><br><br>
        <h1>Album Gunung</h1><br><br><br><br>
        <?php
    session_start();
    // Cek apakah user sudah login atau belum
    if(!isset($_SESSION['userid'])){
        // Jika belum, redirect ke halaman login
        header("location: login-page.php");
        exit; // Penting untuk menghentikan eksekusi script setelah melakukan redirect
    }
?>
              

        <div class="photo-cards">
        <?php
include "conn/koneksi.php";

// Ganti 1 dengan album ID yang Anda inginkan
$album_id = 20;

$sql = mysqli_query($conn, "SELECT * FROM foto,user WHERE foto.userid=user.userid AND foto.albumid = $album_id");
while ($data = mysqli_fetch_array($sql)) {
?>
<div class="photo-card">
    <?php
    if (file_exists("gambar/" . $data['lokasifile'])) {
    ?>
        <img src="gambar/<?= $data['lokasifile'] ?>" width="100%">
    <?php
    } else {
        echo "File tidak ditemukan";
    }
    ?>
    <h2><?= $data['judulfoto'] ?></h2>
    <p><?= $data['deskripsifoto'] ?></p>
    <p>Uploader: <?= $data['namalengkap'] ?></p>
    <p>Jumlah Like: 
        <?php
            $fotoid = $data['fotoid'];
            $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
            echo mysqli_num_rows($sql2);
        ?>
    </p>
    <div class="actions">
        <a href="like.php?fotoid=<?= $data['fotoid'] ?>">Like</a>
        <a href="komentar.php?fotoid=<?= $data['fotoid'] ?>">Komentar</a>
    </div>
</div>
<?php
}
?>

        </div>
    </div>
</body>
</html>
