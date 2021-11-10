<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-folder-o icon-title"></i> Data Rak

        <a class="btn btn-primary btn-social pull-right" href="?module=form_rak&form=add" title="Tambah Data" data-toggle="tooltip">
            <i class="fa fa-plus"></i> Tambah
        </a>
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
            // tampilkan pesan Sukses "Rak barang baru berhasil disimpan"
            elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                Rak barang baru berhasil disimpan.
                </div>";
            }
            // jika alert = 2
            // tampilkan pesan Sukses "Rak barang berhasil diubah"
            elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Rak barang berhasil diubah.
            </div>";
            }
            // jika alert = 3
            // tampilkan pesan Sukses "Rak barang berhasil dihapus"
            elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Rak barang berhasil dihapus.
            </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <!-- tampilan tabel Rak -->
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <!-- <th class="center">Gudang</th> -->
                                <th class="center">Kode Rak</th>
                                <th class="center">Nama Rak</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            $no = 1;
                            // fungsi query untuk menampilkan data dari tabel Rak
                            // $query = mysqli_query($mysqli, "SELECT a.*,b.kode_gudang,b.nama_gudang FROM is_rak as a INNER JOIN is_gudang as b ON a.id_gudang=b.id_gudang ORDER BY a.id_rak DESC")
                            $query = mysqli_query($mysqli, "SELECT * FROM is_rak  ORDER BY id_rak DESC")
                                or die('Ada kesalahan pada query tampil Data Rak: ' . mysqli_error($mysqli));

                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                // menampilkan isi tabel dari database ke tabel di aplikasi
                                // <td width='100'>$data[kode_gudang] - $data[nama_gudang]</td>
                                echo "<tr>
                                <td width='40' class='center'>$no</td>
                                <td width='100'>$data[kode_rak]</td>
                                <td width='250'>$data[nama_rak]</td>
                                <td class='center' width='80'>
                                    <div>
                                    <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_rak&form=edit&id=$data[id_rak]'>
                                        <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                    </a>";
                                        ?>
                                            <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/rak/proses.php?act=delete&id=<?php echo $data['id_rak']; ?>" onclick="return confirm('Anda yakin ingin menghapus data Rak <?php echo $data['nama_rak']; ?> ?');">
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