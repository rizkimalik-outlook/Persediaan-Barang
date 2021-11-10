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
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $kode_rak    = mysqli_real_escape_string($mysqli, trim($_POST['kode_rak']));
            $nama_rak  = mysqli_real_escape_string($mysqli, trim($_POST['nama_rak']));
            // $id_gudang     = mysqli_real_escape_string($mysqli, trim($_POST['gudang']));

            $created_user = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel rak
            $query = mysqli_query($mysqli, "INSERT INTO is_rak(kode_rak,nama_rak,created_user,updated_user) 
                                            VALUES('$kode_rak','$nama_rak','$created_user','$created_user')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=rak&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_rak'])) {
                // ambil data hasil submit dari form
                $id_rak    = mysqli_real_escape_string($mysqli, trim($_POST['id_rak']));
                $nama_rak  = mysqli_real_escape_string($mysqli, trim($_POST['nama_rak']));
                // $id_gudang     = mysqli_real_escape_string($mysqli, trim($_POST['gudang']));

                $updated_user = $_SESSION['id_user'];

                // perintah query untuk mengubah data pada tabel rak
                $query = mysqli_query($mysqli, "UPDATE is_rak SET nama_rak    = '$nama_rak',
                                                                    --  id_gudang       = '$id_gudang',
                                                                     updated_user   = '$updated_user'
                                                               WHERE id_rak      = '$id_rak'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=rak&alert=2");
                }         
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id_rak = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel rak
            $query = mysqli_query($mysqli, "DELETE FROM is_rak WHERE id_rak='$id_rak'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=rak&alert=3");
            }
        }
    }       
}
