<?php
include "koneksi.php";

// ======================
// BUTTON SELESAI
// ======================
if(isset($_GET['selesai'])){

    $id = $_GET['selesai'];

    mysqli_query($conn, "
        UPDATE pesanan
        SET status_pesanan='selesai'
        WHERE id_pesanan='$id'
    ");

    header("Location: pesanan.php");
    exit;
}

// ======================
// FILTER
// ======================
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'belum selesai';

// ======================
// QUERY PESANAN
// ======================
$query = mysqli_query($conn, "
    SELECT *
    FROM pesanan
    WHERE status_pesanan='$filter'
    ORDER BY id_pesanan DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <title>Admin Pesanan - Warkop SDB</title>

    <link rel="stylesheet" href="pesanan.css">

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="header-top">

            <div class="icon-box">🔒</div>

            <div class="logo-area">

                <div class="logo">SDB</div>

                <div>
                    <b>ADMIN WARKOP SDB</b><br>
                    <small>Daftar Pesanan Masuk</small>
                </div>

            </div>

            <div class="icon-box">👨‍💼</div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="filter">

        <a href="?filter=belum selesai">

            <button class="<?php echo ($filter == 'belum selesai') ? 'active' : ''; ?>">

                Belum Selesai

            </button>

        </a>

        <a href="?filter=selesai">

            <button class="<?php echo ($filter == 'selesai') ? 'active' : ''; ?>">

                Selesai

            </button>

        </a>

    </div>

    <!-- LIST PESANAN -->
    <div class="list">

        <?php while($data = mysqli_fetch_assoc($query)) { ?>

        <div class="card">

            <div class="info">

                <!-- ID PESANAN -->
                <b>
                    Pesanan #00<?php echo $data['id_pesanan']; ?>
                </b>

                <!-- NAMA MENU -->
                <p>
                    Menu :
                    <?php echo $data['nama_menu']; ?>
                </p>

                <!-- JUMLAH -->
                <p>
                    Jumlah :
                    <?php echo $data['jumlah']; ?>
                </p>

                <!-- NOMOR MEJA -->
                <p>
                    No Meja :
                    <?php echo $data['no_meja']; ?>
                </p>

            </div>

            <!-- BUTTON SELESAI -->
            <?php if($data['status_pesanan'] == 'belum selesai') { ?>

                <a href="?selesai=<?php echo $data['id_pesanan']; ?>">

                    <button class="selesai-btn">
                        Selesai
                    </button>

                </a>

            <?php } ?>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>