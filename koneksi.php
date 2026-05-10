<?php

$hostname = "localhost";

/* konfigurasi MySQL */
$user_db = "root";
$pass_db = "";
$db_name = "db_warkop"; 

/* membuat koneksi */

$conn = mysqli_connect("localhost", "root", "", "db_warkop");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
 else {

    mysqli_select_db($conn, $db_name);

}

?>