<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
    <!-- tampilan form add data -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Input Gudang
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
            <li><a href="?module=gudang"> Gudang </a></li>
            <li class="active"> Tambah </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" class="form-horizontal" action="modules/gudang/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            // fungsi untuk membuat id transaksi
                            $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_gudang,3) as kode FROM is_gudang
                                                ORDER BY kode_gudang DESC LIMIT 1")
                                or die('Ada kesalahan pada query tampil kode_gudang : ' . mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);

                            if ($count <> 0) {
                                // mengambil data kode_gudang
                                $data_id = mysqli_fetch_assoc($query_id);
                                $kode    = $data_id['kode'] + 1;
                            } else {
                                $kode = 1;
                            }

                            // buat kode_gudang
                            $buat_id   = str_pad($kode, 3, "0", STR_PAD_LEFT);
                            $kode_gudang = "GD$buat_id";
                            ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kode Gudang</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="kode_gudang" value="<?php echo $kode_gudang ?>" autocomplete="off" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Gudang</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_gudang" autocomplete="off" required>
                                </div>
                            </div>

                        </div><!-- /.box body -->

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                    <a href="?module=gudang" class="btn btn-default btn-reset">Batal</a>
                                </div>
                            </div>
                        </div><!-- /.box footer -->
                    </form>
                </div><!-- /.box -->
            </div>
            <!--/.col -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
<?php
}
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        // fungsi query untuk menampilkan data dari tabel gudang
        $query = mysqli_query($mysqli, "SELECT * FROM is_gudang WHERE id_gudang='$_GET[id]'")
            or die('Ada kesalahan pada query tampil Data gudang : ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
    }
?>
    <!-- tampilan form edit data -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Ubah Gudang
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
            <li><a href="?module=gudang"> Gudang </a></li>
            <li class="active"> Ubah </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" class="form-horizontal" action="modules/gudang/proses.php?act=update" method="POST">
                        <div class="box-body">

                            <input type="hidden" name="id_gudang" value="<?php echo $data['id_gudang']; ?>">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kode Gudang</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="kode_gudang" autocomplete="off" value="<?php echo $data['kode_gudang']; ?>" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Gudang</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_gudang" autocomplete="off" value="<?php echo $data['nama_gudang']; ?>" required>
                                </div>
                            </div>

                        </div><!-- /.box body -->

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                    <a href="?module=gudang" class="btn btn-default btn-reset">Batal</a>
                                </div>
                            </div>
                        </div><!-- /.box footer -->
                    </form>
                </div><!-- /.box -->
            </div>
            <!--/.col -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
<?php
}
?>