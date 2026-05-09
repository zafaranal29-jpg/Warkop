<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Penjualan Detail - Warkop SDB</title>
    <style>
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
        max-width: 1100px; /* Lebar ditambah karena kolom lebih banyak */
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

      /* Tabel Styling */
      .table-container {
        overflow-x: auto;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        min-width: 900px;
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

      .status-lunas {
        background-color: #d1fae5;
        color: #065f46;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
      }

      .btn-edit {
        color: #fbbf24;
        text-decoration: none;
        margin-right: 12px;
      }
      .btn-hapus {
        color: #f87171;
        text-decoration: none;
      }

      tr:hover {
        background-color: #252525;
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
          <input type="date" value="2026-04-15" />
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
              <th class="text-center">Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center"><b>08</b></td>
              <td style="color: #888">14:20</td>
              <td>raka</td>
              <td>Kopi Royal</td>
              <td class="text-center">1</td>
              <td class="text-right">Rp 12.000</td>
              <td class="text-right" style="color: #fff; font-weight: 600">
                Rp 13.200
              </td>
              <td class="text-center">
                <span class="status-lunas">Lunas</span>
              </td>
              <td class="text-center">
                <a href="#" class="btn-edit">Edit</a>
                <a href="#" class="btn-hapus">Hapus</a>
              </td>
            </tr>
            <tr>
              <td class="text-center"><b>03</b></td>
              <td style="color: #888">14:45</td>
              <td>Santi</td>
              <td>Indomie Rebus</td>
              <td class="text-center">2</td>
              <td class="text-right">Rp 10.000</td>
              <td class="text-right" style="color: #fff; font-weight: 600">
                Rp 22.000
              </td>
              <td class="text-center">
                <span class="status-lunas">Lunas</span>
              </td>
              <td class="text-center">
                <a href="#" class="btn-edit">Edit</a>
                <a href="#" class="btn-hapus">Hapus</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
