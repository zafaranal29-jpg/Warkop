<?php
include 'koneksi.php';

$data_menu = [];

// Ambil data menu + kategori
$query = "SELECT menu.*, kategori_menu.nama_kategori
          FROM menu
          INNER JOIN kategori_menu
          ON menu.id_kategori = kategori_menu.id_kategori";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_menu[] = $row;
    }
} else {
    die("Gagal mengambil data: " . mysqli_error($conn));
}

// Konversi array PHP ke JSON untuk JavaScript
$json_menu = json_encode($data_menu);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>

    <link rel="stylesheet" href="stok_barang.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2 class="title">Stok Barang</h2>

    <a href="dashboard_admin.php">
        <button class="btn-back">⬅ BACK</button>
    </a>
</div>

<div class="container">

    <!-- BUTTON FILTER -->
    <div class="slider">
        <div class="slider-box">

            <button class="btn aktif"
                id="btnMakanan"
                onclick="filterMenu('Makanan', 'btnMakanan')">
                Makanan
            </button>

            <button class="btn"
                id="btnMinuman"
                onclick="filterMenu('Minuman', 'btnMinuman')">
                Minuman
            </button>

            <button class="btn"
                id="btnCemilan"
                onclick="filterMenu('Cemilan', 'btnCemilan')">
                Cemilan
            </button>

        </div>
    </div>

    <!-- HEADER TABEL -->
    <div class="table-header">
        <div class="col-no">No</div>
        <div class="col-nama">Nama Menu</div>
        <div class="col-stok">Stok</div>
        <div class="col-action">Aksi</div>
    </div>

    <!-- LIST MENU -->
    <div class="list" id="list-menu">

    </div>

    <!-- BUTTON TAMBAH -->
    <div class="bottom-bar">
        <button class="btn-add"
            onclick="window.location.href='tambah_menu.php'">

            + Tambah Menu Baru

        </button>
    </div>

</div>

<script>

// Data menu dari PHP
const dataMenu = <?php echo $json_menu; ?>;


// FILTER MENU
function filterMenu(kategori, btnId) {

    // Reset tombol aktif
    document.querySelectorAll('.btn').forEach(btn => {
        btn.classList.remove('aktif');
    });

    // Tambah class aktif ke tombol yang diklik
    document.getElementById(btnId).classList.add('aktif');

    // Ambil container list
    const listContainer = document.getElementById("list-menu");

    // Kosongkan isi lama
    listContainer.innerHTML = "";

    // Filter data berdasarkan kategori
    const menuFiltered = dataMenu.filter(item =>
        item.nama_kategori.toLowerCase() === kategori.toLowerCase()
    );

    // Jika data kosong
    if (menuFiltered.length === 0) {

        listContainer.innerHTML = `
            <div class="item" style="justify-content:center;">
                Data ${kategori} belum tersedia
            </div>
        `;

        return;
    }

    // Tampilkan data
    menuFiltered.forEach((item, index) => {

        const row = `
            <div class="item">

                <div class="col-no">
                    ${index + 1}
                </div>

                <div class="col-nama">
                    ${item.nama_menu}
                </div>

                <div class="col-stok">
                    ${item.stok}
                </div>

                <div class="col-action">

                    <button class="btn-hapus"
                        onclick="hapusMenu(${item.id_menu})">

                        Hapus

                    </button>

                    <button class="btn-edit"
                        onclick="editMenu(${item.id_menu})">

                        Edit

                    </button>

                </div>

            </div>
        `;

        listContainer.innerHTML += row;
    });
}


// HAPUS MENU
function hapusMenu(id) {

    const konfirmasi = confirm(
        'Apakah Anda yakin ingin menghapus menu ini?'
    );

    if (konfirmasi) {
        window.location.href = 'hapus_menu.php?id=' + id;
    }
}


// EDIT MENU
function editMenu(id) {
    window.location.href = 'form_edit.php?id=' + id;
}


// LOAD AWAL
window.onload = function () {
    filterMenu('Makanan', 'btnMakanan');
};

</script>

</body>
</html>