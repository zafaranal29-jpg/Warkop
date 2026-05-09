<?php

$hostname = "localhost";

/* konfigurasi MySQL */
$user_db = "root";
$pass_db = "";
$db_name = "db_warkop";

/* membuat koneksi */
$conn = new mysqli($hostname, $user_db, $pass_db);

/* cek koneksi */
if ($conn->connect_error) {

    die("Connection failed : " . $conn->connect_error);

} else {

    mysqli_select_db($conn, $db_name);

}

?>