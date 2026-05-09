<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Penjualan Detail - Warkop SDB</title>
    <style>
      /* CSS Tetap Sama Sesuai UI yang Anda Berikan */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", sans-serif;
      }

      body {
        background-color: #121212;
        color: #ffffff;
        padding: 20px;
      }

      .container {
        max-width: 1100px;
        margin: 0 auto;
        background: #1e1e1e;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
      }

      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        border-bottom: 1px dashed #444;
        padding-bottom: 20px;
      }

      .filter-group {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
      }

      input[type="date"] {
        background-color: #2a2a2a;
        color: #ffffff;
        border: 1px solid #444;
        padding: 8px 12px;
        border-radius: 8px;
        outline: none;
      }

      input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        opacity: 0.6;
      }

      .table-container {
        overflow-x: auto;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        min-width: 800px;
      }

      th {
        text-align: left;
        color: #888;
        font-size: 11px;
        text-transform: uppercase;
        padding: 15px 10px;
        border-bottom: 1px solid #333;
        letter-spacing: 0.5px;
      }

      td {
        padding: 15px 10px;
        border-bottom: 1px solid #2a2a2a;
        font-size: 13.5px;
      }

      .text-right {
        text-align: right;
      }
      .text-center {
        text-align: center;
      }

      tr:hover {
        background-color: #252525;
      }

      /* Style untuk pesan jika data kosong */
      .empty-state {
        text-align: center;
        padding: 40px;
        color: #555;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <header>
        <div>
          <h2 style="font-weight: 600">Data Penjualan</h2>
          <p style="color: #888; font-size: 12px">
            Monitoring Transaksi Real-time
          </p>
        </div>
        <div class="filter-group">
          <span style="font-size: 11px; color: #888; margin-bottom: 5px"
            >PILIH TANGGAL</span
          >
          <input type="date" id="filter-tanggal" />
        </div>
      </header>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th class="text-center">No Meja</th>
              <th>Jam</th>
              <th>Nama Pelanggan</th>
              <th>Pesanan</th>
              <th class="text-center">Jumlah</th>
              <th class="text-right">Harga (Awal)</th>
              <th class="text-right">Total (+PPN)</th>
            </tr>
          </thead>
          <tbody id="table-body">
            <!-- Data akan diisi oleh JavaScript -->
          </tbody>
        </table>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        // Set default tanggal hari ini di input filter
        const inputTanggal = document.getElementById("filter-tanggal");
        const hariIni = new Date().toISOString().split("T")[0];
        inputTanggal.value = hariIni;

        // Ambil data dari localStorage
        const keranjang = JSON.parse(localStorage.getItem("keranjang")) || [];
        const noMeja = localStorage.getItem("nomorMeja") || "-";
        const namaPelanggan = localStorage.getItem("namaPemesan") || "Umum";
        const waktuFull = localStorage.getItem("waktuTransaksi") || "";

        // Ambil jam saja dari string waktu (Misal: "14:20")
        const jam = waktuFull.split("•")[1]
          ? waktuFull.split("•")[1].trim()
          : "-";

        const tableBody = document.getElementById("table-body");

        if (keranjang.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="7" class="empty-state">Belum ada data transaksi hari ini.</td></tr>`;
          return;
        }

        // Render data ke dalam tabel
        let htmlContent = "";
        let subtotalKeseluruhan = 0;

        keranjang.forEach((item) => {
          const hargaAwal = item.harga;
          const totalPerItem = item.harga * item.jumlah;
          const totalPlusPPN = totalPerItem + totalPerItem * 0.1;

          htmlContent += `
            <tr>
              <td class="text-center"><b>${noMeja.padStart(2, "0")}</b></td>
              <td style="color: #888">${jam}</td>
              <td>${namaPelanggan}</td>
              <td>${item.nama}</td>
              <td class="text-center">${item.jumlah}</td>
              <td class="text-right">Rp ${hargaAwal.toLocaleString("id-ID")}</td>
              <td class="text-right" style="color: #fff; font-weight: 600">
                Rp ${totalPlusPPN.toLocaleString("id-ID")}
              </td>
            </tr>
          `;
        });

        tableBody.innerHTML = htmlContent;
      });
    </script>
  </body>
</html>
