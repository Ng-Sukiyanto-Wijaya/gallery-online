<?php
    session_start();
    if (!isset($_SESSION['userid'])) {
        header("location:login.php");
        exit; // Pastikan untuk keluar setelah mengalihkan pengguna
    }

    // Include koneksi
    include "conn/koneksi.php";

    // Ambil fotoid dari parameter URL
    $fotoid = $_GET['fotoid'];

    // Query untuk mendapatkan informasi tentang foto
    $sql_foto = mysqli_query($conn, "SELECT * FROM foto WHERE fotoid='$fotoid'");
    $data_foto = mysqli_fetch_array($sql_foto);

    // Jika tidak ada data foto, mungkin foto tersebut tidak ada atau ada kesalahan URL, maka alihkan kembali ke halaman sebelumnya
    if (!$data_foto) {
        header("location:index.php");
        exit;
    }

    // Logika penghapusan komentar
    if (isset($_POST['delete_comment'])) {
        $comment_id = $_POST['comment_id'];
        $user_id = $_SESSION['userid'];
        $is_admin = ($_SESSION['status'] == 'admin'); // Asumsi $_SESSION['role'] menyimpan peran pengguna

        // Hanya memperbolehkan penghapusan jika komentar tersebut milik user yang sedang login ATAU jika user adalah admin
        $sql_check_comment = "SELECT * FROM komentarfoto WHERE komentarid='$comment_id'";
        if ($is_admin || mysqli_fetch_array(mysqli_query($conn, $sql_check_comment))['userid'] == $user_id) {
            mysqli_query($conn, "DELETE FROM komentarfoto WHERE komentarid='$comment_id'");
            // Opsional: Tambahkan pemberitahuan sukses atau error
        } else {
            // Opsional: Tambahkan pesan error jika pengguna tidak memiliki hak untuk menghapus komentar
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Komentar</title>
    <style>
      /* CSS untuk tata letak dan desain */
      body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
}

.photo-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    margin: 0 auto;
    max-width: 500px;
}

.photo-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.photo-details {
    flex: 1;
    margin-right: 20px; /* Tambahkan margin kanan */
}

.photo-details img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.photo-details p {
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    padding: 10px;
    border-radius: 0 0 8px 8px;
}

.comments {
    width: 40%;
    max-height: 300px; /* Tambahkan ketinggian maksimum */
    overflow-y: auto; /* Tambahkan scrollbar saat diperlukan */
}

.comment {
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 8px;
    background-color: #007bff;
    color: #fff;
    position: relative; /* Tambahkan posisi relatif */
}

.delete-comment-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: #ff0000;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.delete-comment-btn:hover {
    background-color: #cc0000;
}

.user-comment {
    align-self: flex-end;
    background-color: #28a745;
}

.user-name {
    font-weight: bold;
}

.time {
    font-size: 12px;
    color: #666;
}

.comment-container {
    margin: 20px auto;
    max-width: 500px;
}

.comment-input {
    display: flex;
}

.comment-input input[type="text"] {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.comment-input input[type="submit"] {
    padding: 10px 20px;
    margin-left: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.comment-input input[type="submit"]:hover {
    background-color: #0056b3;
}

.back-btn {
    display: block;
    margin: 20px auto;
    text-align: left;
}

.back-btn a {
    text-decoration: none;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    transition: background-color 0.3s;
    display: inline-block;
}

.back-btn a:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <h1>Halaman Komentar</h1>

    <div class="photo-grid">
        <div class="photo-item">
            <div class="photo-details">
                <img src="gambar/<?=$data_foto['lokasifile']?>" alt="<?=$data_foto['deskripsifoto']?>">
                <p><?=$data_foto['deskripsifoto']?></p>
            </div>
            <div class="comments">
            <?php
$sql_komentar = mysqli_query($conn, "SELECT komentarfoto.*, user.namalengkap FROM komentarfoto JOIN user ON komentarfoto.userid = user.userid WHERE komentarfoto.fotoid = '$fotoid'");
while($data_komentar = mysqli_fetch_array($sql_komentar)){
?>
    <div class="comment <?= ($data_komentar['userid'] == $_SESSION['userid']) ? 'user-comment' : '' ?>">
        <span class="user-name"><?=$data_komentar['namalengkap']?></span>
        <p><?=$data_komentar['isikomentar']?></p>
        <span class="time"><?=$data_komentar['tanggalkomentar']?></span>
        <?php 
    // Tampilkan tombol hapus hanya jika komentar adalah milik pengguna yang sedang login atau jika pengguna adalah admin
    if ($data_komentar['userid'] == $_SESSION['userid'] || $_SESSION['status'] == 'admin') {
        echo '<form method="post" action=""><input type="hidden" name="comment_id" value="' . $data_komentar['komentarid'] . '"><button type="submit" name="delete_comment" class="delete-comment-btn">Hapus</button></form>';
    }
?>

    </div>
<?php
}
?>
            </div>
        </div>
    </div>

    <form action="tambah_komentar.php" method="post">
        <!-- Form untuk menambahkan komentar -->
        <input type="text" name="fotoid" value="<?=$fotoid?>" hidden>
        <div class="comment-container">
            <div class="comment-input">
                <input type="text" name="isikomentar" placeholder="Tulis komentar...">
                <input type="submit" value="Kirim">
            </div>
        </div>
    </form>

    <div class="back-btn">
    <a href="pmdg.php">Kembali</a>
</div>


</body>
</html>

</body>
</html>
