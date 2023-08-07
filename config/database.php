<?php
// deklarasi parameter koneksi database
$server   = "localhost";
$username = "root";
$password = "";
$database = "persediaan_barang";

// $username = "u654786374_skripsi2";
// $password = "354un99UL";
// $database = "u654786374_skripsi2";
// koneksi database
$mysqli = new mysqli($server, $username, $password, $database);

// cek koneksi
if ($mysqli->connect_error) {
    die('Koneksi Database Gagal : '.$mysqli->connect_error);
	
}
?>