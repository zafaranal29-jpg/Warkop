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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WARKOP SDB</title>
    <link rel="stylesheet" href="menu.css">
</head>

<body>

<div class="phone-frame">
    <div class="container">
        <div class="header">
            <div class="header-top">
                <a href="dashboard.php" class="back-btn"> ← </a>
                <div class="logo-area">
                    <div class="logo">SDB</div>
                    <div>
                        <b>WARKOP SDB</b><br>
                        <small>SUKA DUKA BERSAMA</small>
                    </div>
                </div>
                <div class="icon-box" onclick="document.getElementById('cartPopup').classList.add('show')"> 🛒 </div>
            </div>
            <input type="text" id="searchMenu" placeholder="Cari menu kesukaanmu..." onkeyup="cariMenu()">
        </div>

        <div class="banner">
            <span class="badge">WARKOP SDB</span>
            <h3>Spesial Menu</h3>
            <p>Warkop SDB, warung kopi dengan harga merakyat.</p>
            <button>Coba Sekarang</button>
        </div>

        <h3 class="judul">Menu Favorit</h3>

        <div class="slider">
            <div class="slider-box">
                <button class="btn-filter aktif" id="btnSemua" onclick="filterMenu('Semua', 'btnSemua')">Semua</button>
                <button class="btn-filter" id="btnMakanan" onclick="filterMenu('Makanan', 'btnMakanan')">Makanan</button>
                <button class="btn-filter" id="btnMinuman" onclick="filterMenu('Minuman', 'btnMinuman')">Minuman</button>
                <button class="btn-filter" id="btnCemilan" onclick="filterMenu('Cemilan', 'btnCemilan')">Cemilan</button>
            </div>
        </div>

        <div class="menu-list" id="list-menu"></div>
    </div>

    <div class="cart-popup" id="cartPopup">
        <div class="cart-header">
            <h3>Pesanan</h3>
            <span id="closeCart"> ✕ </span>
        </div>

        <div id="cartItems">
            <p class="kosong">Belum ada pesanan</p>
        </div>

        <div class="cart-footer">
            <div class="grand-total">
                Total : <span id="grandTotal">Rp 0</span>
            </div>
            <button class="btn-checkout" onclick="pindahKeCheckout()">
                Pesan Sekarang
            </button>
        </div>
    </div>
</div>

<script>
const dataMenu = <?php echo $json_menu; ?>;
let cart = [];

// =======================
// PINDAH KE CHECKOUT (REVISI BARU)
// =======================
function pindahKeCheckout() {
    if (cart.length === 0) {
        alert("Keranjang masih kosong!");
        return;
    }

    // Menyimpan data keranjang ke memori browser (localStorage)
    // Nama key 'keranjang_warkop' harus sama dengan yang dipanggil di checkout.php
    localStorage.setItem('keranjang_warkop', JSON.stringify(cart));

    // Pindah ke halaman checkout
    window.location.href = 'checkout.php';
}

// =======================
// FILTER MENU
// =======================
function filterMenu(kategori, btnId) {
    document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('aktif'));
    document.getElementById(btnId).classList.add('aktif');

    const listContainer = document.getElementById("list-menu");
    listContainer.innerHTML = "";

    const menuFiltered = dataMenu.filter(item => {
        if(kategori == "Semua") return true;
        return item.nama_kategori.toLowerCase() === kategori.toLowerCase();
    });

    if(menuFiltered.length === 0){
        listContainer.innerHTML = `<div class="card">Data ${kategori} belum tersedia</div>`;
        return;
    }

    menuFiltered.forEach((item) => {
        const row = `
        <div class="card">
            <div class="img">
                <div class="rating"> ⭐ ${item.rating} </div>
            </div>
            <div class="info">
                <b>${item.nama_menu}</b>
                <p>${item.deskripsi ?? '-'}</p>
                <span class="harga">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</span>
            </div>
            <button class="btn-tambah" onclick="tambahKeranjang('${item.nama_menu}', ${item.harga})"> Tambah </button>
        </div>`;
        listContainer.innerHTML += row;
    });
}

// =======================
// TAMBAH KERANJANG
// =======================
function tambahKeranjang(nama, harga){
    const existing = cart.find(item => item.nama === nama);
    if(existing){
        existing.qty++;
    } else {
        cart.push({
            nama: nama,
            harga: harga,
            qty: 1
        });
    }
    renderCart();
}

// =======================
// RENDER CART
// =======================
function renderCart(){
    const cartItems = document.getElementById("cartItems");
    const grandTotal = document.getElementById("grandTotal");
    const cartPopup = document.getElementById("cartPopup");

    cartItems.innerHTML = "";
    let totalSemua = 0;

    if(cart.length === 0){
        cartItems.innerHTML = `<p class="kosong">Belum ada pesanan</p>`;
    }

    cart.forEach((item, index) => {
        const subtotal = item.harga * item.qty;
        totalSemua += subtotal;

        cartItems.innerHTML += `
        <div class="cart-item">
            <div class="cart-info">
                <b>${item.nama}</b>
                <p>Rp ${item.harga.toLocaleString('id-ID')}</p>
            </div>
            <div class="cart-action">
                <button onclick="kurangQty(${index})">-</button>
                <span>${item.qty}</span>
                <button onclick="tambahQty(${index})">+</button>
            </div>
            <div class="subtotal">Rp ${subtotal.toLocaleString('id-ID')}</div>
        </div>`;
    });

    grandTotal.innerText = "Rp " + totalSemua.toLocaleString('id-ID');
    cartPopup.classList.add("show");
}

function tambahQty(index){ cart[index].qty++; renderCart(); }
function kurangQty(index){ 
    cart[index].qty--; 
    if(cart[index].qty <= 0){ cart.splice(index, 1); }
    renderCart(); 
}

document.getElementById("closeCart").addEventListener("click", function(){
    document.getElementById("cartPopup").classList.remove("show");
});

function cariMenu(){
    const keyword = document.getElementById("searchMenu").value.toLowerCase();
    const cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        const namaMenu = card.querySelector(".info b").innerText.toLowerCase();
        card.style.display = namaMenu.includes(keyword) ? "flex" : "none";
    });
}

window.onload = function(){ filterMenu('Semua', 'btnSemua'); };
</script>
</body>
</html>