<?php
include 'koneksi.php';

// Ambil transaksi terakhir
$query = mysqli_query($conn, "
    SELECT * FROM transaksi
    ORDER BY id_transaksi DESC
    LIMIT 1
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data transaksi tidak ditemukan");
}

$no_meja      = $data['no_meja'];
$tanggal      = $data['tanggal_pesan'];
$total_harga  = $data['total_harga'];
$id_transaksi = $data['id_transaksi'];

// Ambil data pesanan
$queryPesanan = mysqli_query($conn, "
    SELECT nama_menu, jumlah
    FROM pesanan
    WHERE id_transaksi = '$id_transaksi'
");
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>

    <style>

        body{
            background:#0d1117;
            color:white;
            font-family:Segoe UI;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            margin:0;
            padding:20px;
        }

        .container{
            width:100%;
            max-width:400px;
        }

        .struk-card{
            background:white;
            color:#333;
            border-radius:15px;
            padding:25px;
        }

        .struk-header{
            display:flex;
            justify-content:space-between;
            border-bottom:1px dashed #ccc;
            padding-bottom:15px;
            font-size:14px;
        }

        .no-meja-section{
            text-align:center;
            padding:20px 0;
            border-bottom:1px dashed #ccc;
        }

        .no-meja-section h1{
            font-size:60px;
            margin:10px 0;
        }

        .detail-pesanan{
            padding:20px 0;
        }

        .item{
            margin-bottom:15px;
            border-bottom:1px solid #eee;
            padding-bottom:10px;
        }

        .nama-menu{
            font-weight:bold;
            margin-bottom:5px;
        }

        .jumlah{
            color:#666;
            font-size:14px;
        }

        .total-row{
            display:flex;
            justify-content:space-between;
            border-top:1px solid #ddd;
            padding-top:15px;
            margin-top:15px;
            font-weight:bold;
            font-size:18px;
        }

        .btn-kembali{
            display:block;
            text-align:center;
            margin-top:20px;
            background:#161b22;
            color:white;
            padding:15px;
            text-decoration:none;
            border-radius:10px;
            font-weight:bold;
        }

    </style>
</head>

<body>

<div class="container">

    <div style="text-align:center; margin-bottom:20px;">
        <h2>Pesanan Berhasil!</h2>
        <p>Terima kasih, silakan tunggu pesanan Anda</p>
    </div>

    <div class="struk-card">

        <!-- HEADER -->
        <div class="struk-header">

            <strong>Warkop SDB</strong>

            <span>
                <?= date('d M Y H:i', strtotime($tanggal)); ?>
            </span>

        </div>

        <!-- NOMOR MEJA -->
        <div class="no-meja-section">

            <span>No. Meja</span>

            <h1>
                <?= str_pad($no_meja, 2, "0", STR_PAD_LEFT); ?>
            </h1>

        </div>

        <!-- DETAIL PESANAN -->
        <div class="detail-pesanan">

            <?php while($pesanan = mysqli_fetch_assoc($queryPesanan)) { ?>

                <div class="item">

                    <!-- NAMA MENU -->
                    <div class="nama-menu">
                        <?= $pesanan['nama_menu']; ?>
                    </div>

                    <!-- JUMLAH -->
                    <div class="jumlah">
                        Jumlah Pesanan :
                        <?= $pesanan['jumlah']; ?>
                    </div>

                </div>

            <?php } ?>

            <!-- TOTAL -->
            <div class="total-row">

                <span>Total Bayar</span>

                <span>
                    Rp <?= number_format($total_harga,0,',','.'); ?>
                </span>

            </div>

        </div>

    </div>

    <a href="menu.php" class="btn-kembali">
        Kembali ke Menu
    </a>

</div>

</body>
</html>