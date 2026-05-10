<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data dari fetch
    $id_pesanan   = $_POST['id_pesanan'];
    $no_meja      = $_POST['no_meja'];
    $metode       = $_POST['metode_bayar'];
    $total        = $_POST['total_harga'];
    $nama         = $_POST['nama_user'];
    $subtotal     = $_POST['subtotal'];
    $ppn          = $_POST['ppn'];
    $status       = $_POST['status_transaksi'];
    
    // Tanggal otomatis menggunakan waktu sekarang (WIB)
    date_default_timezone_set('Asia/Jakarta');
    $tanggal_pesan = date('Y-m-d H:i:s');

    // Query INSERT (id_transaksi tidak perlu dimasukkan karena biasanya Auto Increment)
  // Urutan kolom di (sini) harus SAMA PERSIS dengan urutan variabel di VALUES('sini')
// Query yang sudah gue benerin urutannya biar pas sama database lo
    $sql = "INSERT INTO transaksi (id_pesanan, no_meja, tanggal_pesan, metode_bayar, total_harga, status_transaksi, nama_user, subtotal, ppn) 
            VALUES ('$id_pesanan', '$no_meja', '$tanggal_pesan', '$metode', '$total', '$status', '$nama', '$subtotal', '$ppn')";

    if (mysqli_query($conn, $sql)) {
        echo "Berhasil";
    } else {
        // Ini buat jaga-jaga kalau masih error, biar ketahuan rusaknya di mana
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>