<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = $_POST['nama'];
    $meja   = $_POST['meja'];
    $metode = $_POST['metode'];
    $total  = $_POST['total'];
    $pesanan = $_POST['pesanan']; // Berisi data JSON dari keranjang

    // Simpan ke tabel penjualan (Sesuaikan nama tabel & kolom Anda)
    $sql = "INSERT INTO data_penjualan (nama_pemesan, nomor_meja, metode_pembayaran, total_bayar, detail_pesanan) 
            VALUES ('$nama', '$meja', '$metode', '$total', '$pesanan')";

    if (mysqli_query($conn, $sql)) {
        echo "Berhasil";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>