<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = $_POST['nama_user'];
    $meja   = $_POST['no_meja'];
    $metode = $_POST['metode_bayar'];
    $total  = $_POST['total_harga'];
    $pesanan = $_POST['pesanan']; // Berisi data JSON dari keranjang

    // Simpan ke tabel penjualan (Sesuaikan nama tabel & kolom Anda)
    $sql = "INSERT INTO transaksi (nama_user, no_meja, metode_bayar, total_harga, detail_pesanan) 
            VALUES ('$nama', '$meja', '$metode', '$total', '$pesanan')";

    if (mysqli_query($conn, $sql)) {
        echo "Berhasil";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>