<?php
include 'koneksi.php';

// Memeriksa apakah ada permintaan GET dengan parameter ID
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Menghapus data mahasiswa dari tabel
    $sql = "DELETE FROM mahasiswa WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Data mahasiswa berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Menutup koneksi
mysqli_close($conn);
?>
