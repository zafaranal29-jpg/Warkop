<?php
include "koneksi.php";

// Menangkap data dari Fetch di Checkout
$no_meja = $_POST['no_meja'];
$nama_user = $_POST['nama_user'];
$detail_pesanan = json_decode($_POST['detail_pesanan'], true);
$status_default = "belum selesai";

if (!empty($detail_pesanan)) {
    foreach ($detail_pesanan as $item) {
        $nama_menu = mysqli_real_escape_string($conn, $item['nama']);
        $jumlah = (int)$item['qty'];

        // Masukkan nama_user ke dalam query agar admin tahu siapa yang pesan
        // Jika di tabelmu kolomnya bernama 'nama_customer', sesuaikan namanya
        $sql = "INSERT INTO pesanan (no_meja, nama_menu, jumlah, status_pesanan, nama_user) 
                VALUES ('$no_meja', '$nama_menu', $jumlah, '$status_default', '$nama_user')";
        
        mysqli_query($conn, $sql);
    }
    echo "Sukses";
} else {
    echo "Data Kosong";
}
?>