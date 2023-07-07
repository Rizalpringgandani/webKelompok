<?php
include "koneksi.php";



// Memeriksa apakah ada permintaan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nim = $_POST["nim"];
    $nama = $_POST["nama"];

    // Menambahkan data ke tabel mahasiswa
    $sql = "INSERT INTO mahasiswa (nim, nama) VALUES ('$nim', '$nama')";
    if (mysqli_query($conn, $sql)) {
        echo "<h1>Data mahasiswa berhasil ditambahkan.</h1>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}
?>

