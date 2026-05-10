<?php
include "koneksi.php";

// ===============================
// FILTER TANGGAL
// ===============================
$tanggal = isset($_GET['tanggal']) 
    ? $_GET['tanggal'] 
    : date('Y-m-d');

// ===============================
// AMBIL DATA TRANSAKSI
// ===============================
$query = mysqli_query($conn, "
    SELECT * FROM transaksi
    WHERE DATE(tanggal_pesan) = '$tanggal'
    ORDER BY id_transaksi DESC
");
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - Warkop SDB</title>

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI',sans-serif;
    }

    body{
        background:#121212;
        color:white;
        padding:20px;
    }

    .container{
        max-width:1100px;
        margin:auto;
        background:#1e1e1e;
        padding:25px;
        border-radius:15px;
    }

    header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
        border-bottom:1px dashed #444;
        padding-bottom:20px;
    }

    input[type="date"]{
        background:#2a2a2a;
        color:white;
        border:1px solid #444;
        padding:8px 12px;
        border-radius:8px;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th{
        text-align:left;
        color:#888;
        font-size:11px;
        text-transform:uppercase;
        padding:15px 10px;
        border-bottom:1px solid #333;
    }

    td{
        padding:15px 10px;
        border-bottom:1px solid #2a2a2a;
        font-size:13px;
    }

    tr:hover{
        background:#252525;
    }

    .text-center{
        text-align:center;
    }

    .text-right{
        text-align:right;
    }

    </style>
</head>

<body>

<div class="container">

    <header>

        <div>
            <h2>Data Penjualan</h2>
            <p style="color:#888;font-size:12px;">
                Monitoring Transaksi Real-time
            </p>
        </div>

        <form method="GET">
            <input 
                type="date" 
                name="tanggal"
                value="<?php echo $tanggal; ?>"
                onchange="this.form.submit()"
            >
        </form>

    </header>

    <table>

        <thead>

            <tr>
                <th class="text-center">No Meja</th>
                <th>Jam</th>
                <th>Nama Pelanggan</th>
                <th>Metode Bayar</th>
                <th class="text-right">Subtotal</th>
                <th class="text-right">Total</th>
            </tr>

        </thead>

        <tbody>

        <?php if(mysqli_num_rows($query) > 0){ ?>

            <?php while($data = mysqli_fetch_assoc($query)){ ?>

            <tr>

                <td class="text-center">
                    <b><?php echo $data['no_meja']; ?></b>
                </td>

                <td>
                    <?php echo date('H:i', strtotime($data['tanggal_pesan'])); ?>
                </td>

                <td>
                    <?php echo $data['nama_user']; ?>
                </td>

                <td>
                    <?php echo $data['metode_bayar']; ?>
                </td>

                <td class="text-right">
                    Rp <?php echo number_format($data['subtotal']); ?>
                </td>

                <td class="text-right">
                    <b>
                        Rp <?php echo number_format($data['total_harga']); ?>
                    </b>
                </td>

            </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="7" class="text-center" style="padding:40px;color:#777;">
                    Belum ada transaksi
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>