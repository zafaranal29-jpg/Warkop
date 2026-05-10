<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Warkop SDB</title>
    <link rel="stylesheet" href="dashboard_admin.css">
</head>
<body>

    <!-- HEADER / NAVBAR -->
    <div class="header">
        <!-- KIRI -->
        <div>
            <h2 class="title">Dashboard Admin</h2>
            <p class="subtitle">Warkop SDB</p>
        </div>

        <!-- KANAN -->
        <div class="profile-box">
            <span class="admin-name">Admin</span>
            <img src="profile.jpg" class="profile-img" alt="Profile">
            <a href="dashboard.php">
                <button class="btn-logout">Logout</button>
            </a>
        </div>
    </div>

    <!-- MENU UTAMA -->
    <div class="menu">
        <a href="pesanan.php" style="text-decoration: none;">
            <button class="menu-btn">Menu Pesanan</button>
        </a>

        <a href="data_penjualan.php" style="text-decoration: none;">
            <button class="menu-btn">Data Penjualan</button>
        </a>

        <a href="stok_barang.php" style="text-decoration: none;">
            <button class="menu-btn">Stok Barang</button>
        </a>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>by Bintang Saputra 20240801231, M. Hafidz Zafaran 20240801110, Anggiant Dwi Raka 20240801231120</p>
        <p>Universitas Esa Unggul | Prodi Teknik Informatika | Pemrograman Web</p>
    </div>

</body>
</html>