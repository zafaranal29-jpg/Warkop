<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Struk Pembayaran - Warkop SDB</title>
    <style>
      body {
        background-color: #0d1117;
        color: #fff;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        padding: 20px;
      }

      .container {
        width: 100%;
        max-width: 400px;
        text-align: center;
      }

      .success-msg h2 {
        margin-bottom: 5px;
      }
      .success-msg p {
        color: #aaa;
        font-size: 0.9rem;
        margin-bottom: 20px;
      }

      .struk-card {
        background-color: #fff;
        color: #333;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
      }

      .struk-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px dashed #ccc;
        padding-bottom: 15px;
        font-size: 0.85rem;
      }

      .no-meja-section {
        padding: 20px 0;
        border-bottom: 1px dashed #ccc;
      }

      .no-meja-section span {
        font-size: 0.8rem;
        color: #777;
        text-transform: uppercase;
      }
      .no-meja-section h1 {
        font-size: 4rem;
        margin: 5px 0;
        font-family: "Georgia", serif;
      }

      .detail-pesanan {
        padding: 20px 0;
        text-align: left;
      }

      .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.95rem;
      }

      .total-row {
        border-top: 1px solid #eee;
        padding-top: 15px;
        font-weight: bold;
        font-size: 1.1rem;
      }

      .barcode-section {
        margin-top: 15px;
      }

      .barcode-section img {
        width: 60%;
        filter: grayscale(1);
      }

      .footer-note {
        font-size: 0.75rem;
        color: #888;
        margin-top: 15px;
      }

      .btn-kembali {
        display: block;
        width: 100%;
        padding: 15px;
        background-color: #161b22;
        color: #fff;
        text-decoration: none;
        border-radius: 10px;
        font-weight: bold;
        margin-top: 20px;
        transition: 0.3s;
      }

      .btn-kembali:hover {
        background-color: #30363d;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="success-msg">
        <h2>Pesanan Berhasil!</h2>
        <p>Terima kasih, silakan tunggu pesanan Anda</p>
      </div>

      <div class="struk-card">
        <div class="struk-header">
          <strong>Warkop SDB</strong>
          <span id="waktu-struk">15 April 2026 • 14:20</span>
        </div>

        <div class="no-meja-section">
          <span>No. Meja</span>
          <h1 id="struk-meja">00</h1>
        </div>

        <div class="detail-pesanan" id="struk-item-list">
          <!-- Data item pesanan akan diisi JS -->
        </div>

        <div class="row total-row">
          <span>Total Bayar</span>
          <span id="struk-total">Rp 0</span>
        </div>

        <div class="barcode-section">
          <img
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png"
            alt="QR Code"
          />
        </div>

        <p class="footer-note">Simpan struk ini sebagai bukti pengambilan</p>
      </div>

      <a href="menu.php" class="btn-kembali">Kembali ke Menu</a>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        // 1. Ambil data dari localStorage
        const keranjang = JSON.parse(localStorage.getItem("keranjang")) || [];
        const noMeja = localStorage.getItem("nomorMeja") || "00";
        const waktu = localStorage.getItem("waktuTransaksi") || "Sekarang";

        // 2. Tampilkan Nomor Meja dan Waktu
        document.getElementById("struk-meja").innerText = noMeja.padStart(
          2,
          "0",
        );
        document.getElementById("waktu-struk").innerText = waktu;

        // 3. Render Daftar Item
        const itemList = document.getElementById("struk-item-list");
        let subtotal = 0;
        itemList.innerHTML = "";

        keranjang.forEach((item) => {
          const itemTotal = item.harga * item.jumlah;
          subtotal += itemTotal;
          itemList.innerHTML += `
                    <div class="row">
                        <span>${item.nama} (x${item.jumlah})</span>
                        <span>Rp ${itemTotal.toLocaleString("id-ID")}</span>
                    </div>
                `;
        });

        // 4. Hitung PPN dan Total Akhir
        const ppn = subtotal * 0.1;
        const totalAkhir = subtotal + ppn;

        itemList.innerHTML += `
                <div class="row">
                    <span>PPN (10%)</span>
                    <span>Rp ${ppn.toLocaleString("id-ID")}</span>
                </div>
            `;

        document.getElementById("struk-total").innerText =
          `Rp ${totalAkhir.toLocaleString("id-ID")}`;
      });
    </script>
  </body>
</html>
