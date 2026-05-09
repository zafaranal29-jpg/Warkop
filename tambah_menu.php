<?php

include 'koneksi.php';

// ================================
// CEK KONEKSI DATABASE
// ================================
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}


// ================================
// SIMPAN DATA MENU
// ================================
if (isset($_POST['simpan'])) {

    $nama_menu   = mysqli_real_escape_string($conn, $_POST['nama_menu']);
    $id_kategori = $_POST['id_kategori'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];

    // Query tambah menu
    $query_tambah = "
        INSERT INTO menu
        (id_kategori, nama_menu, harga, stok)
        VALUES
        ('$id_kategori', '$nama_menu', '$harga', '$stok')
    ";

    $simpan = mysqli_query($conn, $query_tambah);

    // Jika berhasil
    if ($simpan) {

        echo "
        <script>
            alert('Menu berhasil ditambahkan!');
            window.location.href='stok_barang.php';
        </script>
        ";

        exit;

    } else {

        echo "
        <script>
            alert('Gagal menyimpan menu!');
        </script>
        ";

        echo mysqli_error($conn);
    }
}


// ================================
// AMBIL DATA KATEGORI
// ================================
$query_kategori = mysqli_query($conn, "
    SELECT * FROM kategori_menu
");

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Menu</title>

    <link rel="stylesheet" href="stok_barang.css">

    <style>

        body{
            background-color:#0d1117;
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
            border-color:#58a6ff;
            outline:none;
        }

        .btn-box{
            display:flex;
            justify-content:flex-end;
            gap:15px;
            margin-top:20px;
        }

        .btn-save{
            background:#238636;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:6px;
            cursor:pointer;
            font-weight:bold;
        }

        .btn-save:hover{
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
        Tambah Menu Baru
    </h2>

    <hr style="border:1px solid #30363d; margin:20px 0;">

    <form method="POST">

        <!-- NAMA MENU -->
        <div class="form-group">

            <label>Nama Menu</label>

            <input
                type="text"
                name="nama_menu"
                required
                placeholder="Contoh : Es Teh"
            >

        </div>


        <!-- KATEGORI -->
        <div class="form-group">

            <label>Kategori</label>

            <select name="id_kategori" required>

                <option value="">
                    -- Pilih Kategori --
                </option>

                <?php
                while($kategori = mysqli_fetch_assoc($query_kategori)) {
                ?>

                    <option value="<?php echo $kategori['id_kategori']; ?>">

                        <?php echo $kategori['nama_kategori']; ?>

                    </option>

                <?php
                }
                ?>

            </select>

        </div>


        <!-- STOK -->
        <div class="form-group">

            <label>Stok</label>

            <input
                type="number"
                name="stok"
                required
                placeholder="0"
            >

        </div>


        <!-- HARGA -->
        <div class="form-group">

            <label>Harga</label>

            <input
                type="number"
                name="harga"
                required
                placeholder="Rp"
            >

        </div>


        <!-- BUTTON -->
        <div class="btn-box">

            <a href="stok_barang.php" class="btn-cancel">
                Batal
            </a>

            <button
                type="submit"
                name="simpan"
                class="btn-save"
            >
                Simpan Menu
            </button>

        </div>

    </form>

</div>

</body>
</html>