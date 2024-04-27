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
      <a href="#projects" class="w3-bar-item w3-button">Categories</a>
      <?php
      // Memulai sesi
      session_start();
      
      // Memeriksa apakah pengguna adalah admin
      if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){
      ?>
      <!-- Menampilkan tombol control jika pengguna adalah admin -->
      <a href="halaman_admin.php" class="w3-bar-item w3-button">Control Panel</a>
      <?php
      }
      ?>
      
      <?php
      // Memeriksa apakah pengguna sudah login
      if(isset($_SESSION['username'])){
      ?>
      <!-- Menampilkan pesan sambutan dan tombol logout jika pengguna sudah login -->
      <a href="#" class="w3-bar-item w3-button">Welcome, <?php echo $_SESSION['username']; ?></a>
      <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
      <?php 
      } else { 
      ?>
      <!-- Menampilkan tombol login jika pengguna belum login -->
      <a href="login-page.php" class="w3-bar-item w3-button">Login</a>
      <?php 
      } 
      ?>
       
      <!-- Menampilkan link ke bagian About Us -->
      <a href="#footer" class="w3-bar-item w3-button">About Us</a> 
      <?php
// Memeriksa apakah pengguna sudah login dan bukan admin
if(isset($_SESSION['username']) && $_SESSION['username'] != 'admin'){
?>
<!-- Menampilkan tombol + hanya untuk pengguna biasa -->
<button class="btn" onclick="window.location.href='foto.php'" style="background-color: #007bff;">+</button>
<?php
}
?>
    </div>
  </div>
</div>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tombol +</title>
    <style>
        /* CSS untuk latar belakang */
        body {
            background-color: blue; /* Warna latar belakang */
        }

        /* CSS untuk styling tombol */
        .btn {
            padding: 10px 20px; /* Atur padding agar tombol terlihat lebih besar */
            background-color: #007bff; /* Warna latar belakang tombol */
            color: #fff; /* Warna teks */
            border: none; /* Hilangkan border */
            border-radius: 5px; /* Rounding border */
            cursor: pointer; /* Ubah kursor saat dihover menjadi pointer */
        }

        /* CSS untuk hover effect */
        .btn:hover {
            background-color: #0056b3; /* Ubah warna latar belakang saat dihover */
        }
    </style>
</head>
<body>
    <!-- Tombol dengan tanda tambah (+) di dalamnya -->
   
</body>
</html>


    </div>
  </div>
</div>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Categories</h3>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <p><button class="w3-display-topleft w3-black w4-padding category-box" onclick="window.location.href='#pmdg'">Pemandangan</button></p>
        <img src="" alt="House" style="width:100%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <p><button class="w3-display-topleft w3-black w4-padding category-box" onclick="window.location.href='#games'">Games</button></p>
        <img src="" alt="House" style="width:100%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <p><button class="w3-display-topleft w3-black w4-padding category-box" onclick="window.location.href='#villa'">Villa</button></p>
        <img src="" alt="" style="width:100%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <p><button class="w3-display-topleft w3-black w4-padding category-box" onclick="window.location.href='#iphone'">Phone</button></p>
        <img src="/w3images/" alt="House" style="width:100%">
      </div>
    </div>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <p><button class="w3-display-topleft w3-black w4-padding category-box" onclick="window.location.href='#laptop'">Gaming Laptop</button></p>
        <img src="/w3images/" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <p><button class="w3-display-topleft w3-black w4-padding category-box" onclick="window.location.href='#kursi'">Gaming Chair</button></p>
        <img src="" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <p><button class="w3-display-topleft w3-black w4-padding category-box" onclick="window.location.href='#makan'">Makanan Indonesia</button></p>
        <img src="" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <p><button class="w3-display-topleft w3-black w4-padding category-box" onclick="window.location.href='#gunung'">Gunung</button></p>
        <img src="" alt="House" style="width:99%">
      </div>
    </div>
  </div>

  <!-- Carousel Section -->
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  </style>
</head>
<body>

<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="cr1.jpg" alt="Los Angeles" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Villa</h3>
        <p>We love Villa !</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="cr2.jpg" alt="Chicago" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Mountain</h3>
        <p>Thank you, Mountain !</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="cr3.jpg" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Games</h3>
        <p>We had such a great Game !</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div><br><br><br><br><br><br><br><br>

</body>
</html>

  <!DOCTYPE html>
<html>
<head>
<style>
div.gallery {
  border: 1px solid #ccc;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

.category-box {
  width: 200px;
  height: 35px;
}
</style>
</head>
<body>

<div class="responsive" id="pmdg">
  <div class="gallery">
    <a target="_blank" href="pmdg-mlm/pmdg1.jpg">
      <img src="pmdg-mlm/pmdg1.jpg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="pmdg-mlm/pmdg2.jpg">
      <img src="pmdg-mlm/pmdg2.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="pmdg-mlm/pmdg.3.jpg">
      <img src="pmdg-mlm/pmdg.3.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here </div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="pmdg-mlm/pmdg4.jpg">
      <img src="pmdg-mlm/pmdg4.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>
<a style="position:relative; left:1420px; '" href="pmdg.php">More...</a>

<div class="clearfix"></div><br><br><br><br><br><br><br><br>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="responsive" id="games">
  <div class="gallery">
    <a target="_blank" href="game/gm1.jpg">
      <img src="game/gm1.jpg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="game/gm2.jpg">
      <img src="game/gm2.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="game/gm3.jpg">
      <img src="game/gm3.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="game/gm4.jpg">
      <img src="game/gm4.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>
<a style="position:relative; left:1420px; '" href="game.php">More...</a>

<div class="clearfix"></div><br><br><br><br><br><br><br><br>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="responsive" id="villa">
  <div class="gallery">
    <a target="_blank" href="villa/vil1.jpg">
      <img src="villa/vil1.jpg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="villa/vil2.jpg">
      <img src="villa/vil2.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="villa/vil3.jpg">
      <img src="villa/vil3.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="villa/vil4.jpg">
      <img src="villa/vil4.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>
<a style="position:relative; left:1420px; '" href="villa.php">More...</a>

<div class="clearfix"></div><br><br><br><br><br><br><br><br>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="responsive" id="iphone">
  <div class="gallery">
    <a target="_blank" href="ip/ip.jpg">
      <img src="ip/ip.jpg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="ip/ip2.jpg">
      <img src="ip/ip2.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="ip/ip3.jpg">
      <img src="ip/ip3.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="ip/ip4.jpg">
      <img src="ip/ip4.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>
<a style="position:relative; left:1420px; '" href="Iphone.php">More...</a>

<div class="clearfix"></div><br><br><br><br><br><br><br><br>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="responsive" id="laptop">
  <div class="gallery">
    <a target="_blank" href="lpt/lpt.jpg">
      <img src="lpt/lpt.jpg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="lpt/lptp2.jpg">
      <img src="lpt/lptp2.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="lpt/lptp3.jpg">
      <img src="lpt/lptp3.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="lpt/lptp4.jpg">
      <img src="lpt/lptp4.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>
<a style="position:relative; left:1420px; '" href="gaminglaptop.php">More...</a>

<div class="clearfix"></div><br><br><br><br><br><br><br><br>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="responsive" id="kursi">
  <div class="gallery">
    <a target="_blank" href="krs/krs.jpg">
      <img src="krs/krs.jpg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="krs/krs2.jpg">
      <img src="krs/krs2.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="krs/krs3.jpg">
      <img src="krs/krs3.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="krs/krs4.jpg">
      <img src="krs/krs4.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>
<a style="position:relative; left:1420px; '" href="gamingchair.php">More...</a>

<div class="clearfix"></div><br><br><br><br><br><br><br><br>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="responsive" id="makan">
  <div class="gallery">
    <a target="_blank" href="mkn/mkn.jpg">
      <img src="mkn/mkn.jpg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="mkn/mkn2.jpg">
      <img src="mkn/mkn2.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="mkn/mkn3.jpg">
      <img src="mkn/mkn3.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="mkn/mkn4.jpg">
      <img src="mkn/mkn4.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>
<a style="position:relative; left:1420px; '" href="makananindo.php">More...</a>

<div class="clearfix"></div><br><br><br><br><br><br><br><br>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="responsive" id="gunung">
  <div class="gallery">
    <a target="_blank" href="gng/gng.jpg">
      <img src="gng/gng.jpg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>


<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="gng/gng2.jpg">
      <img src="gng/gng2.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="gng/gng3.jpg">
      <img src="gng/gng3.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="gng/gng4.jpg">
      <img src="gng/gng4.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
  </div>
</div>
<a style="position:relative; left:1420px; '" href="gunung.php">More...</a>

<div class="clearfix"></div><br><br><br><br><br><br><br><br>

</body>
</html>
<!-- End page content -->
</div>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16" id="footer">
  <p>Copy Right By Ng Sukiyanto Wijaya<br>XII RPL<br>Batam 2024<a href="" title="" target="_blank" class="w3-hover-text-green"></a></p>
</footer>

</body>
</html>
