<?php
include "koneksi.php";

// ======================
// BUTTON SELESAI SEMUA
// ======================
if(isset($_GET['selesai_semua'])){
    $nama = $_GET['selesai_semua'];
    $meja = $_GET['meja'];

    mysqli_query($conn, "
        UPDATE pesanan 
        SET status_pesanan='selesai' 
        WHERE nama_user='$nama' AND no_meja='$meja' AND status_pesanan='belum selesai'
    ");

    header("Location: pesanan.php");
    exit;
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'belum selesai';

$query = mysqli_query($conn, "
    SELECT 
        MIN(id_pesanan) as id_pesanan, 
        nama_user, 
        no_meja, 
        status_pesanan,
        GROUP_CONCAT(CONCAT(nama_menu, ' (', jumlah, ')') SEPARATOR '<br>') as list_menu,
        SUM(jumlah) as total_qty
    FROM pesanan
    WHERE status_pesanan='$filter'
    GROUP BY nama_user, no_meja, status_pesanan
    ORDER BY id_pesanan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - Warkop SDB</title>
    <link rel="stylesheet" href="pesanan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>

    <header class="navbar">
        <div class="nav-left">
            <h1>Pesanan Masuk</h1>
            <p>Monitoring Antrean Warkop SDB</p>
        </div>
        <a href="dashboard_admin.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> BACK
        </a>
    </header>

    <main class="container">
        <div class="filter-section">
            <a href="?filter=belum selesai" class="btn-filter <?php echo ($filter == 'belum selesai') ? 'active' : ''; ?>">
                <i class="fas fa-clock"></i> Belum Selesai
            </a>
            <a href="?filter=selesai" class="btn-filter <?php echo ($filter == 'selesai') ? 'active' : ''; ?>">
                <i class="fas fa-check-circle"></i> Selesai
            </a>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Nama Customer</th>
                        <th>Menu Pesanan</th>
                        <th width="100">Jumlah</th>
                        <th width="100">No. Meja</th>
                        <th width="150" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
    <?php if(mysqli_num_rows($query) > 0) { ?>
        <?php while($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td class="text-muted">#<?php echo $row['id_pesanan']; ?></td>
            <td><strong class="user-name"><?php echo $row['nama_user']; ?></strong></td>
            
            <td style="line-height: 1.6; padding: 10px 15px;">
                <?php echo $row['list_menu']; ?>
            </td>
            
            <td><span class="qty-badge"><?php echo $row['total_qty']; ?> Porsi</span></td>
            <td><span class="table-badge">Meja <?php echo $row['no_meja']; ?></span></td>
            <td class="action-column">
                <?php if($row['status_pesanan'] == 'belum selesai') { ?>
                    <a href="?selesai_semua=<?php echo $row['nama_user']; ?>&meja=<?php echo $row['no_meja']; ?>" class="btn-done">Selesai</a>
                <?php } else { ?>
                    <span class="status-label">Selesai</span>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    <?php } ?>
</tbody>
            </table>
        </div>
    </main>

</body>
</html>