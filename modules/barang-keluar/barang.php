<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";


if(isset($_POST['id_gudang'])) {
    $query_barang = mysqli_query($mysqli, "SELECT b.id_barang,b.nama_barang
                                            FROM is_barang_masuk as a 
                                            INNER JOIN is_barang as b 
                                            INNER JOIN is_gudang as e
                                                ON a.id_barang=b.id_barang 
                                                AND a.id_gudang=e.id_gudang
                                                WHERE a.id_gudang='$_POST[id_gudang]'
                                            GROUP BY b.id_barang,b.nama_barang
                                            ORDER BY b.id_barang ASC")
                                            or die('Ada kesalahan pada query tampil barang: ' . mysqli_error($mysqli));
    $data=[];
    while ($data_barang = mysqli_fetch_assoc($query_barang)) {
        $data[]=$data_barang;
    }
    echo json_encode($data);
}

if(isset($_POST['id_barang'])) {
    $query_barang = mysqli_query($mysqli, "SELECT a.id_barang_masuk,c.stok,
                                                b.id_rak,b.kode_rak,b.nama_rak,d.nama_satuan
                                            FROM is_barang_masuk as a 
                                            INNER JOIN is_rak as b 
                                            INNER JOIN is_barang as c 
                                            INNER JOIN is_satuan as d 
                                                ON a.id_rak=b.id_rak 
                                                AND a.id_barang=c.id_barang
                                                AND c.id_satuan=d.id_satuan
                                                WHERE a.id_barang='$_POST[id_barang]'")
                                            or die('Ada kesalahan pada query tampil barang: ' . mysqli_error($mysqli));
    $data_barang = mysqli_fetch_assoc($query_barang);

    echo json_encode($data_barang);
}

?> 