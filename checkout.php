<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - Warkop SDB</title>
    <link rel="stylesheet" href="checkout.css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
    <div class="checkout-container">
        <header class="header">
            <a href="menu.php" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="header-text">
                <h1>Checkout</h1>
                <p>Lengkapi data pemesanan</p>
            </div>
        </header>

        <main>
            <section class="card">
                <h3>Pesanan Anda</h3>
                <div id="daftar-pesanan">
                    </div>
            </section>

            <section class="card">
                <h3>Data Pemesan</h3>
                <div class="input-flex">
                    <div class="input-group">
                        <label>Nama Pemesan *</label>
                        <input type="text" id="nama_user" placeholder="Nama Anda" />
                    </div>
                    <div class="input-group" style="flex: 0 0 80px;">
                        <label>Meja *</label>
                        <input type="number" id="no_meja" placeholder="00" />
                    </div>
                </div>
            </section>

            <section class="card">
                <h3>Metode Pembayaran *</h3>
                <div class="payment-options">
                    <label class="payment-item">
                        <input type="radio" name="payment" value="Tunai" checked />
                        <span>Tunai (Kasir)</span>
                    </label>
                    <label class="payment-item">
                        <input type="radio" name="payment" value="QRIS" />
                        <span>QRIS (Scan QR)</span>
                    </label>
                </div>
            </section>

            <section class="card">
                <h3>Rincian Pembayaran</h3>
                <div class="rincian-row">
                    <span>Subtotal</span>
                    <span id="subtotal">Rp 0</span>
                </div>
                <div class="rincian-row">
                    <span>PPN (10%)</span>
                    <span id="ppn">Rp 0</span>
                </div>
                <hr />
                <div class="total-row">
                    <span class="total-label">Total Tagihan</span>
                    <span class="total-value" id="total_harga">Rp 0</span>
                </div>
                <button class="btn-konfirmasi" id="btn-konfirmasi">
                    Konfirmasi Pesanan
                </button>
            </section>
        </main>
    </div>

    <div id="modal-pembayaran" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <div id="modal-body">
                <img id="img-instruksi" src="" alt="Instruksi" style="max-width: 150px; margin-bottom: 15px; border-radius: 10px;" />
                <p id="teks-instruksi" style="font-weight: bold; font-size: 1rem; color: #58a6ff"></p>
                <p style="font-size: 0.8rem; color: #8b949e; margin-top: 10px;">Klik 'x' jika sudah selesai</p>
            </div>
        </div>
    </div>

<script>
function renderCheckout() {
    const dataSimpanan = localStorage.getItem("keranjang_warkop");
    const keranjang = JSON.parse(dataSimpanan) || [];
    const daftarPesananElemen = document.getElementById("daftar-pesanan");
    
    if (keranjang.length === 0) {
        alert("Keranjang kosong!");
        window.location.href = "menu.php";
        return;
    }

    let subtotal = 0;
    daftarPesananElemen.innerHTML = "";

    keranjang.forEach((item) => {
        const totalHargaItem = item.harga * item.qty;
        subtotal += totalHargaItem;

        daftarPesananElemen.innerHTML += `
        <div class="item-pesanan">
            <div class="item-info">
                <strong>${item.nama}</strong>
                <p>${item.qty} x Rp ${item.harga.toLocaleString("id-ID")}</p>
            </div>
            <div class="item-harga">Rp ${totalHargaItem.toLocaleString("id-ID")}</div>
        </div>`;
    });

    const ppn = subtotal * 0.1;
    const total = subtotal + ppn;

    document.getElementById("subtotal").innerText = `Rp ${subtotal.toLocaleString("id-ID")}`;
    document.getElementById("ppn").innerText = `Rp ${ppn.toLocaleString("id-ID")}`;
    document.getElementById("total_harga").innerText = `Rp ${total.toLocaleString("id-ID")}`;
}

document.addEventListener("DOMContentLoaded", renderCheckout);

const modal = document.getElementById("modal-pembayaran");
const closeBtn = document.querySelector(".close-btn");
const btnKonfirmasi = document.getElementById("btn-konfirmasi");

btnKonfirmasi.addEventListener("click", function() {
    const namaUser = document.getElementById("nama_user").value;
    const mejaUser = document.getElementById("no_meja").value;
    const metodeInput = document.querySelector('input[name="payment"]:checked');
    const metode = metodeInput ? metodeInput.value : "Tunai";

    if (!namaUser || !mejaUser) {
        alert("Mohon isi Nama dan Nomor Meja!");
        return;
    }

    const keranjang = JSON.parse(localStorage.getItem("keranjang_warkop")) || [];
    const totalHargaRaw = document.getElementById("total_harga").innerText.replace(/[^0-9]/g, "");

    fetch('proses_simpan_checkout.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            'no_meja': mejaUser,
            'nama_user': namaUser,
            'metode_bayar': metode,
            'total_harga': totalHargaRaw,
            'detail_pesanan': JSON.stringify(keranjang)
        })
    });

    const imgInstruksi = document.getElementById("img-instruksi");
    const teksInstruksi = document.getElementById("teks-instruksi");

    if (metode === "Tunai") {
        imgInstruksi.src = "9902534.jpg"; // Pastikan file gambar ada
        teksInstruksi.innerText = "Silahkan menuju kasir";
    } else {
        imgInstruksi.src = "YjQnEfvec3Xgemn9e4syHf.png"; // Pastikan file gambar ada
        teksInstruksi.innerText = "Silahkan scan barcode";
    }

    modal.style.display = "block";
});

closeBtn.onclick = function() {
    localStorage.removeItem("keranjang_warkop");
    window.location.href = "halaman_struk.php";
};
</script>
</body>
</html>