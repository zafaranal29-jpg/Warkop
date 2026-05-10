<!doctype html>
<html lang="id">

<head>

  <meta charset="UTF-8" />

  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  />

  <title>Checkout - Warkop SDB</title>

  <!-- CSS -->
  <link
    rel="stylesheet"
    href="halaman_checkout.css"
  />

  <!-- FONT AWESOME -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  />

</head>

<body>

<div class="checkout-container">

  <!-- HEADER -->
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

    <!-- PESANAN -->
    <section class="card">

      <h3>Pesanan Anda</h3>

      <div id="daftar-pesanan">

        <!-- DATA DARI JS -->

      </div>

    </section>

    <!-- FORM -->
    <section class="card">

      <div class="input-group">

        <label>Nama Pemesan *</label>

        <input
          type="text"
          id="nama"
          placeholder="Masukkan nama Anda"
        />

      </div>

      <div class="input-group">

        <label>Nomor Meja *</label>

        <input
          type="number"
          id="meja"
          placeholder="Nomor meja"
        />

      </div>

    </section>

    <!-- PEMBAYARAN -->
    <section class="card">

      <h3>Metode Pembayaran *</h3>

      <div class="payment-options">

        <label class="payment-item">

          <input
            type="radio"
            name="payment"
            value="Tunai"
            checked
          />

          <span>Tunai (Kasir)</span>

        </label>

        <label class="payment-item">

          <input
            type="radio"
            name="payment"
            value="QRIS"
          />

          <span>QRIS (Scan QR)</span>

        </label>

        <label class="payment-item">

          <input
            type="radio"
            name="payment"
            value="Debit"
          />

          <span>Kartu Debit/Kredit</span>

        </label>

      </div>

    </section>

    <!-- RINCIAN -->
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

        <strong id="total-akhir">Rp 0</strong>

      </div>

      <button
        class="btn-konfirmasi"
        id="btn-konfirmasi"
      >

        Konfirmasi Pesanan -
        <span id="total-btn">Rp 0</span>

      </button>

    </section>

  </main>

</div>

<!-- MODAL -->
<div
  id="modal-pembayaran"
  class="modal"
>

  <div class="modal-content">

    <span class="close-btn">
      &times;
    </span>

    <div id="modal-body">

      <img
        id="img-instruksi"
        src=""
        alt="Instruksi Pembayaran"
        style="
          max-width:150px;
          margin-bottom:15px;
        "
      />

      <p
        id="teks-instruksi"
        style="
          font-weight:bold;
          font-size:1.1rem;
          color:#333;
        "
      ></p>

    </div>

  </div>

</div>

<script>

// ==========================
// RENDER CHECKOUT
// ==========================
function renderCheckout(){

  const dummyPesanan = [

    {
      nama: "Kopi Royal",
      jumlah: 1,
      harga: 12000
    }

  ];

  const keranjang =
    JSON.parse(
      localStorage.getItem("keranjang")
    ) || dummyPesanan;

  const daftarPesananElemen =
    document.getElementById(
      "daftar-pesanan"
    );

  let subtotal = 0;

  daftarPesananElemen.innerHTML = "";

  keranjang.forEach((item) => {

    const totalHargaItem =
      item.harga * item.jumlah;

    subtotal += totalHargaItem;

    daftarPesananElemen.innerHTML += `

      <div class="item-pesanan">

        <div class="item-info">

          <strong>
            ${item.nama}
          </strong>

          <p>

            ${item.jumlah} x
            Rp ${item.harga.toLocaleString("id-ID")}

          </p>

        </div>

        <div class="item-harga">

          Rp ${totalHargaItem.toLocaleString("id-ID")}

        </div>

      </div>

    `;
  });

  // HITUNG TOTAL
  const ppn = subtotal * 0.1;

  const total = subtotal + ppn;

  // TAMPILKAN
  document.getElementById("subtotal")
    .innerText =
      `Rp ${subtotal.toLocaleString("id-ID")}`;

  document.getElementById("ppn")
    .innerText =
      `Rp ${ppn.toLocaleString("id-ID")}`;

  document.getElementById("total-akhir")
    .innerText =
      `Rp ${total.toLocaleString("id-ID")}`;

  document.getElementById("total-btn")
    .innerText =
      `Rp ${total.toLocaleString("id-ID")}`;

}

// ==========================
// LOAD HALAMAN
// ==========================
document.addEventListener(
  "DOMContentLoaded",
  renderCheckout
);

// ==========================
// MODAL
// ==========================
const modal =
  document.getElementById(
    "modal-pembayaran"
  );

const closeBtn =
  document.querySelector(
    ".close-btn"
  );

const btnKonfirmasi =
  document.getElementById(
    "btn-konfirmasi"
  );

// ==========================
// KONFIRMASI
// ==========================
btnKonfirmasi.addEventListener(
  "click",
  function(){

    const namaUser =
      document.getElementById("nama").value;

    const mejaUser =
      document.getElementById("meja").value;

    const metodeInput =
      document.querySelector(
        'input[name="payment"]:checked'
      );

    // VALIDASI
    if(!namaUser || !mejaUser){

      alert(
        "Mohon isi Nama dan Nomor Meja!"
      );

      return;
    }

    // SIMPAN DATA
    localStorage.setItem(
      "nomorMeja",
      mejaUser
    );

    localStorage.setItem(
      "namaPemesan",
      namaUser
    );

    localStorage.setItem(
      "waktuTransaksi",

      new Date().toLocaleString(
        "id-ID",

        {
          day: "numeric",
          month: "long",
          year: "numeric",
          hour: "2-digit",
          minute: "2-digit"
        }

      )

    );

    // METODE PEMBAYARAN
    const metode =
      metodeInput.value;

    const imgInstruksi =
      document.getElementById(
        "img-instruksi"
      );

    const teksInstruksi =
      document.getElementById(
        "teks-instruksi"
      );

    // TUNAI
    if(metode === "Tunai"){

      imgInstruksi.src =
        "9902534.jpg";

      teksInstruksi.innerText =
        "Silahkan menuju kasir";

    }

    // QRIS
    else if(metode === "QRIS"){

      imgInstruksi.src =
        "YjQnEfvec3Xgemn9e4syHf.png";

      teksInstruksi.innerText =
        "Silahkan scan barcode";

    }

    // DEBIT
    else if(metode === "Debit"){

      imgInstruksi.src =
        "gambar-mesin-edc.png";

      teksInstruksi.innerText =
        "Silahkan menuju kasir";

    }

    // TAMPILKAN MODAL
    modal.style.display = "block";

  }
);

// ==========================
// TUTUP MODAL
// ==========================
closeBtn.onclick = function(){

  modal.style.display = "none";

  window.location.href =
    "halaman_struk.php";

};

// KLIK LUAR MODAL
window.onclick = function(event){

  if(event.target == modal){

    modal.style.display = "none";

    window.location.href =
      "halaman_struk.php";

  }

};

</script>

</body>
</html>