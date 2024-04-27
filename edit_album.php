<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Album</title>

</head>
<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    widht: 90%;
    max-width: 1500px;
    margin: auto;
    padding: 240px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

form {
    width: 100%;
}

table {
    width: 100%;
    margin-top: 20px;
}

table tr td {
    padding: 10px 0;
}

table tr td:first-child {
    width: 120px;
    font-weight: bold;
}

input[type="text"] {
    width: calc(100% - 20px);
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
    <div class="container">
        <h1>Halaman Edit Album</h1>

        <form action="update_album.php" method="post">
            <?php
                include "conn/koneksi.php";
                $albumid=$_GET['albumid'];
                $sql=mysqli_query($conn,"select * from album where albumid='$albumid'");
                while($data=mysqli_fetch_array($sql)){
            ?>
            <input type="text" name="albumid" value="<?=$data['albumid']?>" hidden>
            <table>
                <tr>
                    <td>Nama Album</td>
                    <td><input type="text" name="namaalbum" value="<?=$data['namaalbum']?>"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><input type="text" name="deskripsi" value="<?=$data['deskripsi']?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Ubah"></td>
                </tr>
            </table>
            <?php
                }
            ?>
        </form>
    </div>
</body>
</html>
