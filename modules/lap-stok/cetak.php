<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

$no = 1;
// fungsi query untuk menampilkan data dari tabel barang
$query = mysqli_query($mysqli, "SELECT kode_barang,nama_barang,harga_beli,harga_jual,satuan,stok FROM db_barang ORDER BY nama_barang ASC")
                                or die('Ada kesalahan pada query tampil Data Barang: '.mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN STOK BARANG</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
        <div id="title">
            LAPORAN STOK BARANG 
        </div>
        
        <hr><br>

        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">KODE BARANG</th>
                        <th height="20" align="center" valign="middle">NAMA BARANG</th>
                        <th height="20" align="center" valign="middle">HARGA BELI</th>
                        <th height="20" align="center" valign="middle">HARGA JUAL</th>
                        <th height="20" align="center" valign="middle">STOK</th>
                        <th height="20" align="center" valign="middle">SATUAN</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
            $harga_beli = format_rupiah($data['harga_beli']);
            $harga_jual = format_rupiah($data['harga_jual']);
            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='10' height='13' align='center' valign='middle'>$no</td>
                        <td width='10' height='13' align='center' valign='middle'>$data[kode_barang]</td>
                        <td style='padding-left:5px;' width='10' height='13'align='center' valign='middle'>$data[nama_barang]</td>
                        <td style='padding-right:10px;' width='10' height='13' align='center' valign='middle'>Rp. $harga_beli</td>
                        <td style='padding-right:10px;' width='10' height='13' align='center' valign='middle'>Rp. $harga_jual</td>
                        <td style='padding-right:10px;' width='10' height='13' align='center' valign='middle'>$data[stok]</td>
                        <td width='20' height='13' align='center' valign='middle'>$data[satuan]</td>
                    </tr>";
            $no++;
        }
        ?>  
                </tbody>
            </table>

            <div id="footer-tanggal">
                Tangerang, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
            </div>
            <div id="footer-jabatan">
                Admin
            </div>
            
            <div id="footer-nama">
                Dr.H.Andrean Utama Putra S.kom
            </div>
        </div>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
