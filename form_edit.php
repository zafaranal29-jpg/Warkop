<?php

include "koneksi.php";

// ============================
// AMBIL ID MENU
// ============================
$id = $_GET['id'];

// ============================
// AMBIL DATA MENU BERDASARKAN ID
// ============================
$query = mysqli_query($conn, "
    SELECT * FROM menu
    WHERE id_menu='$id'
");

$data = mysqli_fetch_assoc($query);

// ============================
// AMBIL DATA KATEGORI
// ============================
$kategori = mysqli_query($conn, "
    SELECT * FROM kategori_menu
");

// ============================
// PROSES EDIT MENU
// ============================
if(isset($_POST['update'])){

    $nama_menu   = $_POST['nama_menu'];
    $id_kategori = $_POST['id_kategori'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];

    // QUERY UPDATE
    $update = mysqli_query($conn, "
        UPDATE menu
        SET
            nama_menu='$nama_menu',
            id_kategori='$id_kategori',
            stok='$stok',
            harga='$harga'
        WHERE id_menu='$id'
    ");

    // JIKA BERHASIL
    if($update){

        echo "
        <script>

            alert('Menu berhasil diupdate!');

            window.location.href='stok_barang.php';

        </script>
        ";

    } else {

        echo "
        <script>

            alert('Gagal update menu!');

        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Menu</title>

    <link rel="stylesheet" href="stok_barang.css">

    <style>

        body{
            background:#0d1117;
            color:white;
            font-family:sans-serif;
            padding:20px;
        }

        .form-container{
            max-width:500px;
            margin:50px auto;
            background:#161b22;
            padding:30px;
            border-radius:10px;
            border:1px solid #30363d;
        }

        .form-group{
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#58a6ff;
            font-weight:bold;
        }

        input,
        select{
            width:100%;
            padding:12px;
            background:#0d1117;
            border:1px solid #30363d;
            color:white;
            border-radius:6px;
            box-sizing:border-box;
        }

        input:focus,
        select:focus{
            outline:none;
            border-color:#58a6ff;
        }

        .btn-box{
            display:flex;
            justify-content:flex-end;
            gap:15px;
            margin-top:20px;
        }

        .btn-update{
            background:#238636;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:6px;
            cursor:pointer;
            font-weight:bold;
        }

        .btn-update:hover{
            background:#2ea043;
        }

        .btn-cancel{
            text-decoration:none;
            color:#8b949e;
            align-self:center;
        }

        .btn-cancel:hover{
            color:#58a6ff;
        }

    </style>

</head>

<body>

<div class="form-container">

    <h2 style="text-align:center;">
        Edit Menu
    </h2>

    <hr style="border:1px solid #30363d; margin:20px 0;">

    <form method="POST">

        <!-- NAMA MENU -->
        <div class="form-group">

            <label>Nama Menu</label>

            <input
                type="text"
                name="nama_menu"
                value="<?php echo $data['nama_menu']; ?>"
                required
            >

        </div>

        <!-- KATEGORI -->
        <div class="form-group">

            <label>Kategori</label>

            <select name="id_kategori" required>

                <?php while($k = mysqli_fetch_assoc($kategori)) { ?>

                    <option
                        value="<?php echo $k['id_kategori']; ?>"

                        <?php
                        if($k['id_kategori'] == $data['id_kategori']){
                            echo "selected";
                        }
                        ?>
                    >

                        <?php echo $k['nama_kategori']; ?>

                    </option>

                <?php } ?>

            </select>

        </div>

        <!-- STOK -->
        <div class="form-group">

            <label>Stok</label>

            <input
                type="number"
                name="stok"
                value="<?php echo $data['stok']; ?>"
                required
            >

        </div>

        <!-- HARGA -->
        <div class="form-group">

            <label>Harga</label>

            <input
                type="number"
                name="harga"
                value="<?php echo $data['harga']; ?>"
                required
            >

        </div>

        <!-- BUTTON -->
        <div class="btn-box">

            <a href="stok_barang.php"
               class="btn-cancel">

                Batal

            </a>

            <button
                type="submit"
                name="update"
                class="btn-update"
            >

                Update Menu

            </button>

        </div>

    </form>

</div>

</body>
</html>