<?php
include "koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM menu");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Warkop SDB</title>
    <link rel="stylesheet" href="menu.css">
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

        <input type="text" placeholder="Cari menu kesukaanmu...">

    </div>

    <!-- BANNER -->
    <div class="banner">

        <span class="badge">WARKOP SDB</span>

        <h3>Spesial Menu</h3>

        <p>Warkop SDB, warung kopi dengan harga merakyat.</p>

        <button>Coba Sekarang</button>

    </div>

    <!-- MENU -->
    <h3 class="judul">Menu Favorit</h3>

    <div class="filter">
        <button class="active">Semua</button>
        <button>Kopi</button>
        <button>Makanan</button>
        <button>Snack</button>
    </div>

    <div class="menu-list">

        <?php while($data = mysqli_fetch_array($query)) { ?>

        <div class="card">

            <div class="img">

                <div class="rating">
                    ⭐ <?php echo $data['rating']; ?>
                </div>

            </div>

            <div class="info">

                <b>
                    <?php echo $data['nama_menu']; ?>
                </b>

                <p>
                    <?php echo $data['deskripsi']; ?>
                </p>

                <span>
                    Rp <?php echo number_format($data['harga']); ?>
                </span>

            </div>

            <button class="btn">Tambah</button>

            <!-- POPUP -->
            <div class="popup">

                <p>Tambah ke pesanan?</p>

                <div class="qty">

                    <button class="minus">-</button>

                    <span>1</span>

                    <button class="plus">+</button>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

<!-- JAVASCRIPT -->
<script>

const buttons = document.querySelectorAll(".btn");

buttons.forEach(btn => {

    btn.addEventListener("click", function(e) {

        e.stopPropagation();

        document.querySelectorAll(".popup").forEach(p => {
            p.classList.remove("show");
        });

        const card = this.parentElement;
        const popup = card.querySelector(".popup");

        popup.classList.toggle("show");

    });

});

document.addEventListener("click", function() {

    document.querySelectorAll(".popup").forEach(p => {
        p.classList.remove("show");
    });

});

</script>

</body>
</html>