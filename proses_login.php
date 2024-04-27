<?php
include "conn/koneksi.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($sql);

    if ($data['status'] == "admin" || $data['status'] == "user") {
        // Set session values
        $_SESSION['username'] = $username;
        $_SESSION['status'] = $data['status'];
        $_SESSION['userid'] = $data['userid']; // New session value for userid

        // Redirect user based on status
        if ($data['status'] == "admin") {
            header("location: index.php");
        } else {
            header("location: index.php");
        }
        exit(); // Exit after redirect
    }
} else {
    echo "<script>alert('Gagal Login Sob')</script>";
    echo "<script>location='login-page.php?p=user'</script>";
}

mysqli_close($conn);
?>
