<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";


if(isset($_POST['id_barang'])) {
	$id_barang = $_POST['id_barang'];
    $query_barang = mysqli_query($mysqli, "SELECT a.id_barang,a.nama_barang,a.id_satuan,a.stok,b.id_satuan,b.nama_satuan 
                                            FROM is_barang as a INNER JOIN is_satuan as b ON a.id_satuan=b.id_satuan 
                                            WHERE id_barang='$id_barang'")
                                            or die('Ada kesalahan pada query tampil barang: ' . mysqli_error($mysqli));
    $data_barang = mysqli_fetch_assoc($query_barang);

    echo json_encode($data_barang);
}

?> 