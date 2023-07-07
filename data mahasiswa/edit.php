<!-- edit.php -->

<?php
// Include file koneksi.php untuk melakukan koneksi ke database
include 'koneksi.php';

// Cek apakah ada parameter ID yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data mahasiswa berdasarkan ID
    $query = "SELECT * FROM mahasiswa WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Cek apakah data mahasiswa ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Proses update data jika tombol "Update" ditekan
        if (isset($_POST['update'])) {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];

            // Query untuk mengupdate data mahasiswa berdasarkan ID
            $updateQuery = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama' WHERE id = '$id'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                echo "Data mahasiswa berhasil diperbarui.";
            } else {
                echo "Terjadi kesalahan dalam memperbarui data mahasiswa.";
            }
        }
    } else {
        echo "Data mahasiswa tidak ditemukan.";
    }
} else {
    echo "ID mahasiswa tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
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
        <link rel="stylesheet" href="style.css" type="text/css" />
    
</head>
<body>
    <h1>Edit Mahasiswa</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="nim">NIM:</label>
        <input type="text" name="nim" value="<?php echo $row['nim']; ?>" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required><br>

        <input type="submit" name="update" value="Update">
    </form>

    <a href="index.php">Kembali</a>
</body>
</html>
