<?php
include "conn/koneksi.php";
session_start();

// Ensure that all required POST variables are set
if(isset($_POST['nama_album']) && isset($_SESSION['username'])) {
    // Escape special characters to prevent SQL injection
    $nama_album = mysqli_real_escape_string($conn, $_POST['nama_album']);
    $tanggaldibuat = date("Y-m-d");
    $userid = $_SESSION['userid'];

    // Build and execute the SQL query
    $sql = "INSERT INTO album (namaalbum, tanggaldibuat, userid) VALUES ('$nama_album', '$tanggaldibuat', '$userid')";
    if(mysqli_query($conn, $sql)) {
        // Redirect to album.php after successful insertion
        header("Location: album.php");
        exit();
    } else {
        // Handle errors if the query fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle error if required data is missing
    echo "Error: Required data is missing.";
}
?>
