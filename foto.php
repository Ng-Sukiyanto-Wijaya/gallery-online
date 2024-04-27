<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login-page.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Gallery Photo</title>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto</title>
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {}

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
        }

        .item-table th,
        .item-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .item-table th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
        }

        .item-table td {
            text-align: left;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .add-btn {
            background-color: #007bff;
            margin-top: 20px;
        }

        .btn:hover {
            opacity: 0.8;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {}

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        input[type="text"],
        input[type="file"],
        select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="file"] {
            padding: 5px;
        }

        select {
            width: calc(100% - 22px); /* Adjusted to account for the border */
        }

    </style><br><br><br>
    <h1>Halaman Foto</h1>
    <form action="tambah_foto.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judulfoto"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsifoto"></td>
            </tr>
            <tr>
                <td>Lokasi File</td>
                <td><input type="file" name="lokasifile"></td>
            </tr>
            <tr>
                <td>Album</td>
                <td>
                    <select name="albumid">
                        <?php
                        include "conn/koneksi.php";
                        $sql=mysqli_query($conn,"SELECT * FROM album");
                        while($data=mysqli_fetch_array($sql)){
                        ?>
                        <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tambah"></td>
            </tr>
        </table>
    </form>

    <table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Tanggal Unggah</th>
        <th>Lokasi File</th>
        <th>Album</th>
        <th>Disukai</th>
        <th>Aksi</th>
    </tr>
    <?php
    include "conn/koneksi.php";
    $userid = $_SESSION['userid'];
    $sql = mysqli_query($conn, "SELECT * FROM foto,album WHERE foto.userid='$userid' AND foto.albumid=album.albumid");
    while ($data = mysqli_fetch_array($sql)) {
    ?>
    <tr>
        <td><?= $data['fotoid'] ?></td>
        <td><?= $data['judulfoto'] ?></td>
        <td><?= $data['deskripsifoto'] ?></td>
        <td><?= $data['tanggalunggah'] ?></td>
        <td>
            <img src="gambar/<?= $data['lokasifile'] ?>" width="200px">
        </td>
        <td><?= $data['namaalbum'] ?></td>
        <td>
            <?php
            $fotoid = $data['fotoid'];
            $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
            echo mysqli_num_rows($sql2);
            ?>
        </td>
        <td>
            <a href="hapus_foto.php?fotoid=<?= $data['fotoid'] ?>">Hapus</a>
            <a href="edit_foto.php?fotoid=<?= $data['fotoid'] ?>">Edit</a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

    </select>
</td>

            </tr>
            <tr>
                <td></td>
                
            </tr>
        </table>
    </form>

    <table border="1" cellpadding=5 cellspacing=0>
        <tr>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
    <link rel="stylesheet" href="style.css">
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
</head>
<body>
    <div class="container">
        
       
            <tbody>
               
            </tbody>
        </table>
        
    </div>
</body>
</html>
