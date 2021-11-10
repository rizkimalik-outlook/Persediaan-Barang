<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-file-text-o icon-title"></i> Laporan Stok Barang
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Gudang
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="?module=lap_stok">Semua Data</a></li>
                    <li class="divider"></li>
                    <?php
                    $query_gudang = mysqli_query($mysqli, "SELECT id_gudang,nama_gudang FROM is_gudang ORDER BY id_gudang ASC")
                        or die('Ada kesalahan pada query tampil Gudang: ' . mysqli_error($mysqli));
                    while ($data_gudang = mysqli_fetch_assoc($query_gudang)) {
                        echo "<li><a href='?module=lap_stok&gudang=$data_gudang[id_gudang]'>$data_gudang[nama_gudang]</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <a class="btn btn-primary btn-social" href="modules/lap-stok/cetak.php" target="_blank">
                <i class="fa fa-print"></i> Cetak
            </a>
        </div>
    </h1>


</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <!-- tampilan tabel barang -->
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th class="center">ID Barang</th>
                                <th class="center">Nama Barang</th>
                                <th class="center">Jenis Barang</th>
                                <th class="center">Stok</th>
                                <th class="center">Satuan</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            if(isset($_GET['gudang'])){
                                $query = mysqli_query($mysqli, "SELECT a.id_barang,a.nama_barang,a.id_jenis,a.id_satuan,a.stok,b.nama_jenis,c.nama_satuan,d.id_gudang
                                                            FROM is_barang as a INNER JOIN is_jenis_barang as b INNER JOIN is_satuan as c INNER JOIN is_barang_masuk as d
                                                            ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan AND a.id_barang=d.id_barang 
                                                            WHERE d.id_gudang='$_GET[gudang]'
                                                            GROUP BY a.id_barang,a.nama_barang,a.id_jenis,a.id_satuan,a.stok,b.nama_jenis,c.nama_satuan,d.id_gudang
                                                            ORDER BY a.id_barang DESC")
                                or die('Ada kesalahan pada query tampil Data Barang: ' . mysqli_error($mysqli));

                            }
                            else{
                                $query = mysqli_query($mysqli, "SELECT a.id_barang,a.nama_barang,a.id_jenis,a.id_satuan,a.stok,b.nama_jenis,c.nama_satuan
                                                            FROM is_barang as a INNER JOIN is_jenis_barang as b INNER JOIN is_satuan as c 
                                                            ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan
                                                            ORDER BY a.id_barang DESC")
                                or die('Ada kesalahan pada query tampil Data Barang: ' . mysqli_error($mysqli));
                            }
                            
                            $no = 1;

                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                // menampilkan isi tabel dari database ke tabel di aplikasi
                                echo "<tr>
                                <td width='30' class='center'>$no</td>
                                <td width='80' class='center'>$data[id_barang]</td>
                                <td width='200'>$data[nama_barang]</td>
                                <td width='170'>$data[nama_jenis]</td>";
                                            if ($data['stok'] <= 10) { ?>
                                                <td width="80" align="right"><span class="label label-warning"><?php echo $data['stok']; ?></span></td>
                                            <?php
                                            } else { ?>
                                                <td width="80" align="right"><?php echo $data['stok']; ?></td>
                                        <?php
                                            }
                                            echo "   <td width='100'>$data[nama_satuan]</td>
                                </tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div>
                        <strong>Keterangan :</strong> <br>
                        <span style="color:#f0ad4e" class="label label-warning">...</span> = Stok Barang Minim
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content