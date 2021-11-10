<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if (isset($_POST['simpan'])) {
        $data_post      = json_decode($_POST['simpan'], true);
        $created_user   = $_SESSION['id_user'];

        foreach ($data_post as $row) {
            $query_id = mysqli_query($mysqli, "SELECT RIGHT(id_barang_keluar,7) as kode FROM is_barang_keluar
                                                ORDER BY id_barang_keluar DESC LIMIT 1")
                or die('Ada kesalahan pada query tampil id_barang_keluar : ' . mysqli_error($mysqli));

            $count = mysqli_num_rows($query_id);

            if ($count <> 0) {
                // mengambil data id_barang_keluar
                $data_id = mysqli_fetch_assoc($query_id);
                $kode    = $data_id['kode'] + 1;
            } else {
                $kode = 1;
            }

            // buat id_barang_keluar
            $tahun           = date("Y");
            $buat_id         = str_pad($kode, 7, "0", STR_PAD_LEFT);
            $id_barang_keluar = "TK-$tahun-$buat_id";

            //tanggal
            $tanggal         = mysqli_real_escape_string($mysqli, trim($row['tanggal_keluar']));
            $exp             = explode('-',$tanggal);
            $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];

            $query = mysqli_multi_query($mysqli, "INSERT INTO is_barang_keluar(id_barang_keluar,tanggal_keluar,id_barang,id_gudang,id_rak,jumlah_keluar,created_user) 
                                            VALUES('$id_barang_keluar','$tanggal_keluar','$row[id_barang]','$row[id_gudang]','$row[id_rak]','$row[jumlah_keluar]','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
           
            if ($query) {
                // perintah query untuk mengubah data pada tabel barang
                $query1 = mysqli_query($mysqli, "UPDATE is_barang SET stok      = '$row[stok]'
                                                                WHERE id_barang = '$row[id_barang]'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                if ($query1) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    // header("location: ../../main.php?module=barang_keluar&alert=1");
                    echo "success insert";
                }
            }
        }
    }
    else{
        if ($_GET['act']=='approve') {
            if (isset($_GET['id'])) {
                // ambil data hasil submit dari form
                $id_barang_keluar = mysqli_real_escape_string($mysqli, trim($_GET['id']));
                $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_GET['jml']));
                $id_barang        = mysqli_real_escape_string($mysqli, trim($_GET['idb']));
                $stok             = mysqli_real_escape_string($mysqli, trim($_GET['stok']));
                $status           = "Approve";
                $sisa_stok        = $stok - $jumlah_keluar;
    
                // perintah query untuk mengubah data pada tabel barang
                $query = mysqli_query($mysqli, "UPDATE is_barang_keluar SET status              = '$status'
                                                                      WHERE id_barang_keluar    = '$id_barang_keluar'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
    
                /* // cek query
                if ($query) {
                    // perintah query untuk mengubah data pada tabel barang
                    $query1 = mysqli_query($mysqli, "UPDATE is_barang SET stok      = '$sisa_stok'
                                                                    WHERE id_barang = '$id_barang'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
    
                    // cek query
                    if ($query1) {                       
                        // jika berhasil tampilkan pesan berhasil simpan data
                        header("location: ../../main.php?module=barang_keluar&alert=2");
                    }
                }  */
                // cek query
                if ($query) {                       
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=barang_keluar&alert=2");
                }    
            }   
        }
    
        elseif ($_GET['act']=='reject') {
            if (isset($_GET['id'])) {
                // ambil data hasil submit dari form
                $id_barang_keluar = mysqli_real_escape_string($mysqli, trim($_GET['id']));
                $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_GET['jml']));
                $id_barang        = mysqli_real_escape_string($mysqli, trim($_GET['idb']));
                $stok             = mysqli_real_escape_string($mysqli, trim($_GET['stok']));
                $status           = "Reject";
                $sisa_stok        = $stok + $jumlah_keluar;
    
                // perintah query untuk mengubah data pada tabel barang
                $query = mysqli_query($mysqli, "UPDATE is_barang_keluar SET status              = '$status'
                                                                      WHERE id_barang_keluar    = '$id_barang_keluar'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
    
                // cek query
                if ($query) {
                    // perintah query untuk mengubah data pada tabel barang
                    $query1 = mysqli_query($mysqli, "UPDATE is_barang SET stok      = '$sisa_stok'
                                                                    WHERE id_barang = '$id_barang'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
    
                    // cek query
                    if ($query1) {                       
                        // jika berhasil tampilkan pesan berhasil simpan data
                        header("location: ../../main.php?module=barang_keluar&alert=3");
                    }
                }
    
                /* if ($query) {                  
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=barang_keluar&alert=3");
                } */     
            }   
        }
    }

    
}       
?>