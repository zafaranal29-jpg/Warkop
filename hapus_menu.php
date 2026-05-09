<?php

include 'koneksi.php';

// ==========================
// CEK ID MENU
// ==========================
if(isset($_GET['id'])){

    // AMBIL ID MENU
    $id_menu = $_GET['id'];

    // ==========================
    // QUERY HAPUS MENU
    // ==========================
    $hapus = mysqli_query($conn, "
        DELETE FROM menu
        WHERE id_menu='$id_menu'
    ");

    // ==========================
    // JIKA BERHASIL
    // ==========================
    if($hapus){

        echo "
        <script>

            alert('Menu berhasil dihapus!');

            window.location.href =
                'stok_barang.php';

        </script>
        ";

    }else{

        echo "
        <script>

            alert('Menu gagal dihapus!');

            window.location.href =
                'stok_barang.php';

        </script>
        ";
    }

}else{

    header(
        'Location: stok_barang.php'
    );

    exit();
}

?>