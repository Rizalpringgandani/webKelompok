<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form login
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Koneksi ke database
  $conn = new mysqli('localhost', 'root', '', 'dbmhs');

  // Periksa koneksi database
  if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
  }

  // Query untuk memeriksa kecocokan username dan password
  $query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
  $result = $conn->query($query);

  // Jika ditemukan data pengguna dengan username dan password yang cocok
  if ($result->num_rows == 1) {
    // Set status login ke true
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;

    // Redirect ke halaman utama setelah login berhasil
    header("Location: index.php");
    exit;
  } else {
    // Jika username atau password tidak cocok, tampilkan pesan error
    $error = "Username atau password salah.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      text-align: center;
      margin-top: 50px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    p.error {
      color: red;
    }
  </style>
</head>
<body>
  <h2>Silakan Login</h2>

  <?php
  if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
  }
  ?>

  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
  </form>
</body>
</html>
