<!DOCTYPE html>
<html>
<head>
    <title>Login Admin - Warkop SDB</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="header-top">

            <div class="icon-box">←</div>

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

    <form action="dashboard_admin.php" method="POST">

    <label>Username</label>
    <input type="text" name="username" placeholder="Masukkan username">

    <label>Password</label>
    <input type="password" name="password" placeholder="Masukkan password">

    <div>
        <button type="submit">Login</button>
    </div>

</form>

        <small>Hanya untuk admin</small>

    </div>

</div>

</body>
</html>