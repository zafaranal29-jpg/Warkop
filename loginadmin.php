<?php
session_start();
include 'koneksi.php'; // Menggunakan file koneksi yang sudah Anda miliki

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query mencocokkan username & password ke tabel admin
    $query  = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);
        
        // Menyimpan data ke session
        $_SESSION['admin_id']   = $data['id_admin'];
        $_SESSION['username']   = $data['username'];
        $_SESSION['nama_user']  = $data['nama_user'];

        // Redirect ke dashboard
        header("Location: dashboard_admin.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin - Warkop SDB</title>
    <link rel="stylesheet" href="login.css">
    <style>
        .alert-error {
            color: #fff;
            background-color: #e74c3c;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="header-top">
            <div class="icon-box" onclick="window.history.back()" style="cursor:pointer">←</div>
            <div class="logo-area">
                <div class="logo">SDB</div>
                <div>
                    <b>WARKOP SDB</b><br>
                    <small>SUKA DUKA BERSAMA</small>
                </div>
            </div>
            <div class="icon-box">🔔</div>
        </div>
        <input type="text" placeholder="Halaman Admin...">
    </div>

    <!-- LOGIN CARD -->
    <div class="login-card">

        <span class="badge">ADMIN</span>

        <h2>Login Admin</h2>
        <p>Masuk untuk mengelola pesanan Warkop SDB</p>

        <!-- Menampilkan pesan error jika ada -->
        <?php if ($error): ?>
            <div class="alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">

            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <div>
                <button type="submit">Login</button>
            </div>

        </form>

        <small>Hanya untuk admin</small>

    </div>

</div>

</body>
</html>