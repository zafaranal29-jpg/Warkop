<?php
include "koneksi.php";

// QUERY JOIN MENU + KATEGORI
$query = mysqli_query($conn, "
    SELECT 
        menu.*,
        kategori_menu.nama_kategori
    FROM menu
    JOIN kategori_menu
    ON menu.id_kategori = kategori_menu.id_kategori
");

// ARRAY DATA MENU
$data_menu = [];

while($row = mysqli_fetch_assoc($query)){
    $data_menu[] = $row;
}

// JSON
$json_menu = json_encode($data_menu);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>WARKOP SDB</title>

    <link rel="stylesheet" href="menu.css">

</head>

<body>

<div class="phone-frame">

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="header-top">

            <!-- BACK -->
            <a href="dashboard.php"
                class="back-btn">

                ←

            </a>

            <div class="logo-area">

                <div class="logo">SDB</div>

                <div>

                    <b>WARKOP SDB</b><br>

                    <small>
                        SUKA DUKA BERSAMA
                    </small>

                </div>

            </div>

            <div class="icon-box">🔔</div>

        </div>

        <input type="text"
            placeholder="Cari menu kesukaanmu...">

    </div>

    <!-- BANNER -->
    <div class="banner">

        <span class="badge">
            WARKOP SDB
        </span>

        <h3>Spesial Menu</h3>

        <p>
            Warkop SDB, warung kopi
            dengan harga merakyat.
        </p>

        <button>
            Coba Sekarang
        </button>

    </div>

    <!-- JUDUL -->
    <h3 class="judul">
        Menu Favorit
    </h3>

    <!-- SLIDER FILTER -->
    <div class="slider">

        <div class="slider-box">

            <button class="btn-filter aktif"
                id="btnSemua"
                onclick="filterMenu('Semua', 'btnSemua')">

                Semua

            </button>

            <button class="btn-filter"
                id="btnMakanan"
                onclick="filterMenu('Makanan', 'btnMakanan')">

                Makanan

            </button>

            <button class="btn-filter"
                id="btnMinuman"
                onclick="filterMenu('Minuman', 'btnMinuman')">

                Minuman

            </button>

            <button class="btn-filter"
                id="btnCemilan"
                onclick="filterMenu('Cemilan', 'btnCemilan')">

                Cemilan

            </button>

        </div>

    </div>

    <!-- LIST MENU -->
    <div class="menu-list"
        id="list-menu">

    </div>

</div>
</div>

<!-- JAVASCRIPT -->
<script>

const dataMenu =
    <?php echo $json_menu; ?>;


// FILTER MENU
function filterMenu(kategori, btnId) {

    // RESET BUTTON
    document
    .querySelectorAll('.btn-filter')
    .forEach(btn => {

        btn.classList.remove('aktif');

    });

    // ACTIVE BUTTON
    document
    .getElementById(btnId)
    .classList.add('aktif');

    // CONTAINER
    const listContainer =
        document.getElementById("list-menu");

    // KOSONGKAN
    listContainer.innerHTML = "";

    // FILTER DATA
    const menuFiltered =
        dataMenu.filter(item => {

        if(kategori == "Semua"){

            return true;

        }

        return item.nama_kategori
            .toLowerCase()
            === kategori.toLowerCase();

    });

    // JIKA KOSONG
    if(menuFiltered.length === 0){

        listContainer.innerHTML = `

            <div class="card">

                Data ${kategori}
                belum tersedia

            </div>

        `;

        return;

    }

    // LOOP MENU
    menuFiltered.forEach((item) => {

        const row = `

        <div class="card">

            <div class="img">

                <div class="rating">

                    ⭐ ${item.rating}

                </div>

            </div>

            <div class="info">

                <b>
                    ${item.nama_menu}
                </b>

                <p>
                    ${item.deskripsi}
                </p>

                <span class="harga"
                    data-harga="${item.harga}">

                    Rp ${parseInt(item.harga)
                        .toLocaleString('id-ID')}

                </span>

            </div>

            <button class="btn-tambah">

                Tambah

            </button>

            <!-- POPUP -->
            <div class="popup">

                <h4 class="popup-title">

                    ${item.nama_menu}

                </h4>

                <p class="popup-text">

                    Tambah ke pesanan?

                </p>

                <div class="qty">

                    <button class="minus">

                        -

                    </button>

                    <span class="jumlah">

                        1

                    </span>

                    <button class="plus">

                        +

                    </button>

                </div>

                <div class="total">

                    Total :

                    <span class="total-harga">

                        Rp ${parseInt(item.harga)
                        .toLocaleString('id-ID')}

                    </span>

                </div>

                <div class="action-popup">

                    <button class="btn-pesan">

                        Pesan

                    </button>

                </div>

            </div>

        </div>

        `;

        listContainer.innerHTML += row;

    });

    aktifkanPopup();

}


// FUNCTION POPUP
function aktifkanPopup(){

    // BUTTON TAMBAH
    const buttons =
        document.querySelectorAll(".btn-tambah");

    buttons.forEach(btn => {

        btn.addEventListener("click", function(e){

            e.stopPropagation();

            document
            .querySelectorAll(".popup")
            .forEach(p => {

                p.classList.remove("show");

            });

            const card =
                this.parentElement;

            const popup =
                card.querySelector(".popup");

            popup.classList.toggle("show");

        });

    });

    // TOTAL HARGA
    const cards =
        document.querySelectorAll(".card");

    cards.forEach(card => {

        const minus =
            card.querySelector(".minus");

        const plus =
            card.querySelector(".plus");

        const jumlah =
            card.querySelector(".jumlah");

        const hargaElement =
            card.querySelector(".harga");

        const totalHarga =
            card.querySelector(".total-harga");

        const btnPesan =
            card.querySelector(".btn-pesan");

        const namaMenu =
            card.querySelector(".popup-title")
            .innerText;

        let harga =
            parseInt(hargaElement.dataset.harga);

        let qty = 1;

        // TAMBAH
        plus.addEventListener("click", function(e){

            e.stopPropagation();

            qty++;

            jumlah.innerText = qty;

            let total = harga * qty;

            totalHarga.innerText =
                "Rp " +
                total.toLocaleString('id-ID');

        });

        // KURANG
        minus.addEventListener("click", function(e){

            e.stopPropagation();

            if(qty > 1){

                qty--;

                jumlah.innerText = qty;

                let total = harga * qty;

                totalHarga.innerText =
                    "Rp " +
                    total.toLocaleString('id-ID');

            }

        });

        // BUTTON PESAN
        btnPesan.addEventListener("click", function(e){

            e.stopPropagation();

            alert(
                qty + " " +
                namaMenu +
                " berhasil dipesan"
            );

        });

    });

}


// TUTUP POPUP
document.addEventListener("click", function(){

    document
    .querySelectorAll(".popup")
    .forEach(p => {

        p.classList.remove("show");

    });

});


// LOAD AWAL
window.onload = function(){

    filterMenu(
        'Semua',
        'btnSemua'
    );

};

</script>

</body>
</html>