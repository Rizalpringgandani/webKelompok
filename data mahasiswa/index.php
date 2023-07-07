<?php
include 'koneksi.php';

session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  // Jika belum login, redirect ke halaman login
  header("Location: login.php");
  exit;
}

// Proses logout
if (isset($_GET['logout'])) {
  // Hapus semua data session
  session_unset();
  session_destroy();

  // Redirect ke halaman login
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Simply Amazed HTML Template by Tooplate</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /> -->
  <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css" />
  <link rel="stylesheet" href="css/slick.css" type="text/css" />
  <link rel="stylesheet" href="style.css" type="text/css" />
  <link rel="stylesheet" href="css/tooplate-simply-amazed.css" type="text/css" />
  <!--

Tooplate 2123 Simply Amazed

https://www.tooplate.com/view/2123-simply-amazed

-->
</head>

<body>
  <div id="outer">
    <header class="header order-last" id="tm-header">
      <nav class="navbar">
        <div class="collapse navbar-collapse single-page-nav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#section-1"><span class="icn"><i class="fas fa-2x fa-air-freshener"></i></span>
              Daftar Nama</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#section-2"><span class="icn"><i class="fab fa-2x fa-battle-net"></i></span>
              Tambah</a>
            </li>
            <li class="nav-item">
            <a href="index.php?logout=true">Logout</a>
              
            </li>
            
           
            
          </ul>
        </div>
      </nav>
    </header>
    
    <button class="navbar-button collapsed" type="button">
      <span class="menu_icon">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </span>
    </button>
    
    <main id="content-box" class="order-first">
      <div class="banner-section section parallax-window" data-parallax="scroll" data-image-src="img/section-1-bg.jpg" id="section-1">
        <div class="container">
          <?php

          // Mengambil data dari tabel mahasiswa
          $query = "SELECT * FROM mahasiswa";
          $result = $conn->query($query);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

          ?>

              <div class="card" style="max-width: 400px;">
                <h5>Nama Kelompok:</h5>
                <div class="row ">


                  <div class="card-body">
                    <div class="nama">
                      <p class="card-text">Nama: <?php echo $row['nama']; ?></p>
                      <p class="card-text"><small class="text-body-secondary">NIM: <?php echo $row['nim']; ?></small></p>
                    </div>
                    <div class="edit">
                       <a name="" id="" class="btn-edit" href="edit.php?id=<?php echo $row['id']; ?>" role="button"> EDIT</a> 
                       <a name="" id="" class="btn-edit" href="hapus.php?id=<?php echo $row['id']; ?>" role="button"> HAPUS</a>


                    </div>
                    <a href="add.php">Tambah Mahasiswa</a>
                  </div>

                </div>
              </div>
          <?php    }
          } ?>
        </div>
      </div>

      <section class="work-section section" id="section-2">
        <div class="container2">
          <?php
          include "add.php";
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Mengambil data dari form
            $nim = $_POST["nim"];
            $nama = $_POST["nama"];

            // Menambahkan data ke tabel mahasiswa
            $sql = "INSERT INTO mahasiswa (nim, nama) VALUES ('$nim', '$nama')";
            if (mysqli_query($conn, $sql)) {
              echo "Data mahasiswa berhasil ditambahkan.";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
          }
          ?>

          <h2>Tambah Data Mahasiswa</h2>

          <form class="form" method="POST" action="add.php">
            <label class="label" for="nim">NIM:</label>
            <input class="input" type="text" id="nim" name="nim" required><br><br>

            <label class="label" for="nama">Nama:</label>
            <input class="input" type="text" id="nama" name="nama" required><br><br>

            <input class="input" type="submit" value="Tambahkan">
          </form>
          <a href="index.php">Refresh</a>
          
        </div>
      </section>
      
    </main>
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.singlePageNav.min.js"></script>
  <script src="js/slick.js"></script>
  <script src="js/parallax.min.js"></script>
  <script src="js/templatemo-script.js"></script>
  <script>
    // Menggunakan AJAX untuk mengirim data form ke server
    document
      .getElementById("dataForm")
      .addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah refresh halaman saat form dikirim

        var form = document.getElementById("dataForm");
        var name = form.elements["name"].value;
        var email = form.elements["email"].value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "simpan_data.php", true);
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Berhasil menambahkan data, lakukan tindakan yang diperlukan
            getDataFromServer();
            form.reset();
          }
        };
        xhr.send(
          "name=" +
          encodeURIComponent(name) +
          "&email=" +
          encodeURIComponent(email)
        );
      });

    // Mengambil data dari server dan menampilkannya
    function getDataFromServer() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "ambil_data.php", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var data = JSON.parse(xhr.responseText);
          // Tampilkan data dalam elemen HTML yang sesuai
          var dataContainer = document.getElementById("dataContainer");
          dataContainer.innerHTML = ""; // Kosongkan container sebelum menambahkan data baru

          for (var i = 0; i < data.length; i++) {
            var item = data[i];
            var listItem = document.createElement("li");
            listItem.textContent = item.name + " - " + item.email;
            dataContainer.appendChild(listItem);
          }
        }
      };
      xhr.send();
    }

    // Panggil fungsi getDataFromServer saat halaman dimuat
    window.onload = getDataFromServer;
  </script>
</body>

</html>