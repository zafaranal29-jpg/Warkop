<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_menu = $_GET['id'];

    // Memulai transaksi agar jika salah satu gagal, database tetap aman
    mysqli_begin_transaction($conn);

    try {
        // 1. Hapus data di tabel detail_pesanan yang merujuk ke id_menu ini
        $query1 = "DELETE FROM detail_pesanan WHERE id_menu = ?";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1, "i", $id_menu);
        mysqli_stmt_execute($stmt1);

        // 2. Hapus data di tabel menu
        $query2 = "DELETE FROM menu WHERE id_menu = ?";
        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "i", $id_menu);
        mysqli_stmt_execute($stmt2);

        // Jika semua berhasil, simpan perubahan
        mysqli_commit($conn);
        header("Location: stok_barang.php?status=sukses");
        exit();

    } catch (mysqli_sql_exception $exception) {
        // Jika ada error, batalkan semua perubahan
        mysqli_rollback($conn);
        echo "Gagal menghapus menu: " . $exception->getMessage();
    }
} else {
    header("Location: stok_barang.php");
    exit();
}
?>