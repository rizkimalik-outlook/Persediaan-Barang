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
                    <li><a href="?module=form_barang">Semua Data</a></li>
                    <li class="divider"></li>
                    <?php
                    $query_gudang = mysqli_query($mysqli, "SELECT id_gudang,nama_gudang FROM is_gudang ORDER BY id_gudang ASC")
                        or die('Ada kesalahan pada query tampil Gudang: ' . mysqli_error($mysqli));
                    while ($data_gudang = mysqli_fetch_assoc($query_gudang)) {
                        echo "<li><a href='?module=form_barang&gudang=$data_gudang[id_gudang]'>$data_gudang[nama_gudang]</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <a class="btn btn-primary btn-social" href="?module=form_barang&form=add" title="Tambah Data" data-toggle="tooltip">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php
            // fungsi untuk menampilkan pesan
            // jika alert = "" (kosong)
            // tampilkan pesan "" (kosong)
            if (empty($_GET['alert'])) {
                echo "";
            }
            // jika alert = 1
            // tampilkan pesan Sukses "Data barang baru berhasil disimpan"
            elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data barang baru berhasil disimpan.
            </div>";
            }
            // jika alert = 2
            // tampilkan pesan Sukses "Data barang berhasil diubah"
            elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data barang berhasil diubah.
            </div>";
            }
            // jika alert = 3
            // tampilkan pesan Sukses "Data barang berhasil dihapus"
            elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data barang berhasil dihapus.
            </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <!-- tampilan tabel barang -->
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th class="center">ID Barang</th>
                                <th class="center">Kode Barang</th>
                                <th class="center">Nama Barang</th>
                                <th class="center">Jenis Barang</th>
                                <th class="center">Stok</th>
                                <th class="center">Satuan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            $no = 1;
                            // fungsi query untuk menampilkan data dari tabel barang
                            if(isset($_GET['gudang'])){
                                $query = mysqli_query($mysqli, "SELECT a.id_barang,a.kode_barang,a.nama_barang,a.id_jenis,a.id_satuan,a.stok,b.nama_jenis,c.nama_satuan,d.id_gudang
                                                            FROM is_barang as a INNER JOIN is_jenis_barang as b INNER JOIN is_satuan as c INNER JOIN is_barang_masuk as d
                                                            ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan AND a.id_barang=d.id_barang 
                                                            WHERE d.id_gudang='$_GET[gudang]'
                                                            GROUP BY a.id_barang,a.nama_barang,a.id_jenis,a.id_satuan,a.stok,b.nama_jenis,c.nama_satuan,d.id_gudang
                                                            ORDER BY a.id_barang DESC")
                                or die('Ada kesalahan pada query tampil Data Barang: ' . mysqli_error($mysqli));

                            }
                            else{
                                $query = mysqli_query($mysqli, "SELECT a.id_barang,a.kode_barang,a.nama_barang,a.id_jenis,a.id_satuan,a.stok,b.nama_jenis,c.nama_satuan
                                                            FROM is_barang as a INNER JOIN is_jenis_barang as b INNER JOIN is_satuan as c 
                                                            ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan
                                                            ORDER BY a.id_barang DESC")
                                or die('Ada kesalahan pada query tampil Data Barang: ' . mysqli_error($mysqli));
                            }

                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                // menampilkan isi tabel dari database ke tabel di aplikasi
                                echo "<tr>
                                <td width='30' class='center'>$no</td>
                                <td width='80' class='center'>$data[id_barang]</td>
                                <td width='80' class='center'>$data[kode_barang]</td>
                                <td width='180'>$data[nama_barang]</td>
                                <td width='150'>$data[nama_jenis]</td>
                                <td width='80' align='right'>$data[stok]</td>
                                <td width='100'>$data[nama_satuan]</td>
                                <td class='center' width='80'>
                                        <div>
                                        <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_barang&form=edit&id=$data[id_barang]'>
                                            <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                        </a>";
                            ?>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/barang/proses.php?act=delete&id=<?php echo $data['id_barang']; ?>" onclick="return confirm('Anda yakin ingin menghapus barang <?php echo $data['nama_barang']; ?> ?');">
                                    <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                </a>
                            <?php
                                echo " </div>
                                    </td>
                                    </tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content