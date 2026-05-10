<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - Warkop SDB</title>
    <link rel="stylesheet" href="halaman checkout.css" />
    <!-- Font Awesome untuk icon back -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
    <div class="checkout-container">
        <!-- Header dengan tombol kembali -->
        <header class="header">
            <a href="halaman-menu.html" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="header-text">
                <h1>Checkout</h1>
                <p>Lengkapi data pemesanan</p>
            </div>
        </header>

        <main>
            <!-- Bagian Pesanan Anda -->
            <section class="card">
                <h3>Pesanan Anda</h3>
                <div id="daftar-pesanan">
                    <!-- Data dari JS akan muncul di sini -->
                </div>
            </section>

            <!-- Form Data Pemesan -->
            <section class="card">
                <div class="input-group">
                    <label>Nama Pemesan *</label>
                    <input type="text" id="nama_user" placeholder="Masukkan nama Anda" />
                </div>
                <div class="input-group">
                    <label>Nomor Meja *</label>
                    <input type="number" id="no_meja" placeholder="Nomor meja" />
                </div>
            </section>

            <!-- Metode Pembayaran -->
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
                    <label class="payment-item">
                        <input type="radio" name="payment" value="Debit" />
                        <span>Kartu Debit/Kredit</span>
                    </label>
                </div>
            </section>

            <!-- Rincian Pembayaran -->
            <section class="card rincian">
                <h3>Rincian Pembayaran</h3>
                <div class="row">
                    <span>Subtotal</span>
                    <span id="subtotal">Rp 0</span>
                </div>
                <div class="row">
                    <span>PPN (10%)</span>
                    <span id="ppn">Rp 0</span>
                </div>
                <hr />
                <div class="row total">
                    <span>Total</span>
                    <strong id="total_harga">Rp 0</strong>
                </div>
                <button class="btn-konfirmasi" id="btn-konfirmasi">
                    Konfirmasi Pesanan - <span id="total-btn">Rp 0</span>
                </button>
            </section>
        </main>
    </div>
    <!-- Modal Pop-up Pembayaran -->
    <div id="modal-pembayaran" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <div id="modal-body">
                <img id="img-instruksi" src="" alt="Instruksi Pembayaran"
                    style="max-width: 150px; margin-bottom: 15px" />
                <p id="teks-instruksi" style="font-weight: bold; font-size: 1.1rem; color: #333"></p>
            </div>
        </div>
    </div>


    <script>
    // 1. Fungsi untuk menampilkan daftar pesanan dari localStorage
    function renderCheckout() {
        const dummyPesanan = [{
            nama: "Kopi Royal",
            jumlah: 1,
            harga: 12000
        }];
        const keranjang = JSON.parse(localStorage.getItem("keranjang")) || dummyPesanan;
        const daftarPesananElemen = document.getElementById("daftar-pesanan");

        let subtotal = 0;
        daftarPesananElemen.innerHTML = "";

        keranjang.forEach((item) => {
            const totalHargaItem = item.harga * item.jumlah;
            subtotal += totalHargaItem;

            daftarPesananElemen.innerHTML += `
        <div class="item-pesanan">
            <div class="item-info">
                <strong>${item.nama}</strong>
                <p>${item.jumlah} x Rp ${item.harga.toLocaleString("id-ID")}</p>
            </div>
            <div class="item-harga">
                Rp ${totalHargaItem.toLocaleString("id-ID")}
            </div>
        </div>`;
        });

        const ppn = subtotal * 0.1;
        const total = subtotal + ppn;

        document.getElementById("subtotal").innerText = `Rp ${subtotal.toLocaleString("id-ID")}`;
        document.getElementById("ppn").innerText = `Rp ${ppn.toLocaleString("id-ID")}`;
        document.getElementById("total_harga").innerText = `Rp ${total.toLocaleString("id-ID")}`;
        document.getElementById("total-btn").innerText = `Rp ${total.toLocaleString("id-ID")}`;
    }

    document.addEventListener("DOMContentLoaded", renderCheckout);

    // 2. Logika Modal dan Konfirmasi Pembayaran
    const modal = document.getElementById("modal-pembayaran");
    const closeBtn = document.querySelector(".close-btn");
    const btnKonfirmasi = document.getElementById("btn-konfirmasi");

    btnKonfirmasi.addEventListener("click", function() {
        // Ambil input dari user (ID: nama, meja)
        const namaUser = document.getElementById("nama_user").value;
        const mejaUser = document.getElementById("no_meja").value;

        // --- PERBAIKAN: MENGAMBIL METODE PEMBAYARAN ---
        const metodeInput = document.querySelector('input[name="payment"]:checked');
        const metode = metodeInput ? metodeInput.value : "Belum memilih";

        // Validasi
        if (!namaUser || !mejaUser) {
            alert("Mohon isi Nama dan Nomor Meja!");
            return;
        }

        // Ambil nilai total (ID: total-akhir)
        const totalHargaRaw = document.getElementById("total_harga").innerText;
        const totalHarga = totalHargaRaw.replace(/[^0-9]/g, ""); // Hanya ambil angka murni
        const keranjang = JSON.parse(localStorage.getItem("keranjang")) || [];

        // Simpan ke localStorage untuk struk
        localStorage.setItem("no_meja", mejaUser);
        localStorage.setItem("nama_user", namaUser);
        localStorage.setItem("waktu_cetak", new Date().toLocaleString("id-ID"));

        // --- PROSES KIRIM KE DATABASE (Sesuai kolom metode_bayar) ---
        console.log("Mengirim data ke database...");
        fetch('proses_simpan_checkout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'nama_user': namaUser,
                    'no_meja': mejaUser,
                    'metode_bayar': metode, // Dikirim ke $_POST['metode'] di PHP
                    'total_harga': totalHarga,
                    'pesanan': JSON.stringify(keranjang)
                })
            })
            .then(response => response.text())
            .then(res => console.log("Respon Server:", res))
            .catch(err => console.error("Gagal simpan database:", err));

        // Logika konten Pop-up Modal berdasarkan pilihan metode
        const imgInstruksi = document.getElementById("img-instruksi");
        const teksInstruksi = document.getElementById("teks-instruksi");

        if (metode === "Tunai") {
            imgInstruksi.src = "9902534.jpg";
            teksInstruksi.innerText = "Silahkan menuju kasir";
        } else if (metode === "QRIS") {
            imgInstruksi.src = "YjQnEfvec3Xgemn9e4syHf.png";
            teksInstruksi.innerText = "Silahkan scan barcode";
        } else if (metode === "Debit") {
            imgInstruksi.src = "gambar-mesin-edc.png";
            teksInstruksi.innerText = "Silahkan menuju kasir";
        }

        modal.style.display = "block";
    });

    // 3. Fungsi Menutup Modal & Pindah ke Struk
    closeBtn.onclick = function() {
        modal.style.display = "none";
        window.location.href = "halaman struk.php";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            window.location.href = "halaman struk.php";
        }
    };
    </script>

</body>

</html>