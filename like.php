<?php
    include "conn/koneksi.php";
    session_start();

    if(!isset($_SESSION['userid'])){
        // Jika pengguna belum login, alihkan ke halaman login
        header("location:index.php");
    } else {
        $fotoid = $_GET['fotoid'];
        $userid = $_SESSION['userid'];

        // Cek apakah pengguna sudah pernah menyukai foto ini atau belum
        $sql_check_like = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

        if(mysqli_num_rows($sql_check_like) == 1){
            // Jika pengguna sudah menyukai foto ini, lakukan proses unlike
            mysqli_query($conn, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
            // Beri pesan bahwa like telah dibatalkan
            echo "<script>alert('Anda telah membatalkan like untuk foto ini');</script>";
        } else {
            // Jika pengguna belum pernah menyukai foto ini, lakukan proses like
            $tanggallike = date("Y-m-d");
            mysqli_query($conn, "INSERT INTO likefoto VALUES('', '$fotoid', '$userid', '$tanggallike')");
            // Beri pesan sukses jika perlu
            echo "<script>alert('Foto berhasil disukai');</script>";
        }
    }

    // Kembali ke halaman sebelumnya menggunakan JavaScript
    echo "<script>window.history.go(-1);</script>";
?>
