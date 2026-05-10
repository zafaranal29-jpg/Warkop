<?php
include "koneksi.php";

// ==============================
// AMBIL DATA DARI FETCH
// ==============================
$no_meja       = $_POST['no_meja'];
$nama_user     = $_POST['nama_user'];
$metode_bayar  = $_POST['metode_bayar'];
$total_harga   = $_POST['total_harga'];

$detail_pesanan = json_decode($_POST['detail_pesanan'], true);

// ==============================
// HITUNG SUBTOTAL
// ==============================
$subtotal = $total_harga / 1.1;

// ==============================
// SIMPAN KE TABEL TRANSAKSI
// ==============================
mysqli_query($conn, "
    INSERT INTO transaksi
    (
        no_meja,
        metode_bayar,
        total_harga,
        status_transaksi,
        nama_user,
        subtotal
    )
    VALUES
    (
        '$no_meja',
        '$metode_bayar',
        '$total_harga',
        'Lunas',
        '$nama_user',
        '$subtotal'
    )
");

// 🔥 AMBIL ID TRANSAKSI TERBARU (INI WAJIB)
$id_transaksi = mysqli_insert_id($conn);

// ==============================
// SIMPAN KE TABEL PESANAN
// ==============================
foreach($detail_pesanan as $item){

    $nama_menu = $item['nama'];
    $jumlah    = $item['qty'];

    mysqli_query($conn, "
        INSERT INTO pesanan
        (
            no_meja,
            nama_user,
            nama_menu,
            jumlah,
            status_pesanan,
            id_transaksi
        )
        VALUES
        (
            '$no_meja',
            '$nama_user',
            '$nama_menu',
            '$jumlah',
            'belum selesai',
            '$id_transaksi'
        )
    ");
}

echo "success";
?>