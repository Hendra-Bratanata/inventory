<?php
$query = mysqli_query($mysqli, "SELECT * FROM db_barang_masuk ORDER BY kode_transaksi DESC")
    or die('Ada kesalahan pada query tampil Data barang: ' . mysqli_error($mysqli));
$ada = false;
$jumlah = 0;
while ($data = mysqli_fetch_array($query)) {
    $expireddate     = $data['expired'];
    $hariIni        = strtotime(date('Y-m-d'));
    $expProduk      = strtotime($expireddate);
    $sisaHari       = $expProduk - $hariIni;
    $selisihHari    = floor($sisaHari / (60 * 60 * 24));
    // echo "$selisihHari"."<br>";
    if ($selisihHari < 30) {
        
        $jumlah++;
    
    }
   
}
if($jumlah > 0){
    $ada = true;
}



if ($ada) {
    echo "<div class='alert alert-danger alert-dismissable '>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-times-circle'></i>Ada $jumlah Produk Mendekati tanggal Expired < 30 hari !!!</h4>
                     Cek Pada Link Berikut <a href='http://localhost/skripsi2/main.php?module=expired' class='alert-link'><strong> >>> Produk Preoritas!</strong></a>.
                  </div>";
}
