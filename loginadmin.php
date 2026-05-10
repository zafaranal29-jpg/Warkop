<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // CEK LOGIN ADMIN
    $query = "SELECT * FROM admin 
              WHERE username='$username' 
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $data = mysqli_fetch_assoc($result);

        // SESSION
        $_SESSION['admin_id']  = $data['id_admin'];
        $_SESSION['username']  = $data['username'];
        $_SESSION['nama_user'] = $data['nama_user'];

        // PINDAH KE DASHBOARD
        header("Location: dashboard_admin.php");
        exit;

    } else {

        $error = "Username atau Password salah!";

    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="login.css">

    <style>

        .alert-error{
            background:#dc2626;
            color:white;
            padding:12px;
            border-radius:10px;
            margin-bottom:15px;
            text-align:center;
            font-size:14px;
        }

        .btn-back{
            display:inline-block;
            margin-bottom:20px;
            color:#4d9fff;
            text-decoration:none;
            font-size:14px;
            font-weight:600;
            transition:0.3s;
        }

        .btn-back:hover{
            color:white;
        }

    </style>
</head>

<body>

    <div class="login-card">

        <!-- BUTTON BACK -->
        <a href="dashboard.php" class="btn-back">
            ← Kembali
        </a>


        <h2>Login Admin</h2>

        <p>
            Masuk untuk mengelola pesanan Warkop SDB
        </p>

        <!-- ERROR -->
        <?php if($error){ ?>
            <div class="alert-error">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <!-- FORM LOGIN -->
        <form action="" method="POST">

            <label>Username</label>

            <input 
                type="text"
                name="username"
                placeholder="Masukkan username"
                required
            >

            <label>Password</label>

            <input 
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button type="submit">
                Login
            </button>

        </form>

        <small>
            Hanya untuk admin
        </small>

    </div>

</body>
</html>