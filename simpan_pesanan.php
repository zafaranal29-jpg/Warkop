<?php
include "koneksi.php";

// Ambil input JSON dari Fetch API
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['items']) && !empty($input['items'])) {
    $no_meja = $input['no_meja'];
    $status_default = "belum selesai";
    $success = true;

    // Loop setiap item di keranjang untuk dimasukkan ke tabel pesanan
    foreach ($input['items'] as $item) {
        $nama_menu = mysqli_real_escape_string($conn, $item['nama']);
        $jumlah = (int)$item['qty'];

        // Query sesuai struktur tabel kamu: id_pesanan (auto), no_meja, nama_menu, jumlah, status_pesanan
        $sql = "INSERT INTO pesanan (no_meja, nama_menu, jumlah, status_pesanan) 
                VALUES ('$no_meja', '$nama_menu', $jumlah, '$status_default')";
        
        if (!mysqli_query($conn, $sql)) {
            $success = false;
            $error_msg = mysqli_error($conn);
            break;
        }
    }

    if ($success) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $error_msg]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data kosong']);
}
?>