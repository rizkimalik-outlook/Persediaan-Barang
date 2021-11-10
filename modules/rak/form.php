<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
    <!-- tampilan form add data -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Input Rak
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
            <li><a href="?module=rak"> Rak </a></li>
            <li class="active"> Tambah </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" class="form-horizontal" action="modules/rak/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            // fungsi untuk membuat kode rak
                            $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_rak,3) as kode FROM is_rak
                                                ORDER BY kode_rak DESC LIMIT 1")
                                or die('Ada kesalahan pada query tampil kode_rak : ' . mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);

                            if ($count <> 0) {
                                // mengambil data kode_rak
                                $data_id = mysqli_fetch_assoc($query_id);
                                $kode    = $data_id['kode'] + 1;
                            } else {
                                $kode = 1;
                            }

                            // buat kode_rak
                            $buat_id   = str_pad($kode, 3, "0", STR_PAD_LEFT);
                            $kode_rak = "RK$buat_id";
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kode Rak</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="kode_rak" value="<?php echo $kode_rak; ?>" autocomplete="off" readonly required>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-sm-2 control-label">Pilih Gudang</label>
                                <div class="col-sm-5">
                                    <select class="chosen-select" name="gudang" data-placeholder="-- Pilih Gudang --" autocomplete="off" required>
                                        <option value=""></option>
                                        <?php
                                        $query_gudang = mysqli_query($mysqli, "SELECT * FROM is_gudang ORDER BY id_gudang ASC")
                                            or die('Ada kesalahan pada query tampil Gudang: ' . mysqli_error($mysqli));
                                        while ($data_gudang = mysqli_fetch_assoc($query_gudang)) {
                                            echo "<option value=\"$data_gudang[id_gudang]\"> $data_gudang[kode_gudang]  - $data_gudang[nama_gudang] </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Rak</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_rak" autocomplete="off" required>
                                </div>
                            </div>

                        </div><!-- /.box body -->

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                    <a href="?module=rak" class="btn btn-default btn-reset">Batal</a>
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
        // fungsi query untuk menampilkan data dari tabel satuan
        $query = mysqli_query($mysqli, "SELECT * FROM is_rak  WHERE id_rak='$_GET[id]'")
            or die('Ada kesalahan pada query tampil Data Rak : ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
    }
?>
    <!-- tampilan form edit data -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Ubah Satuan Barang
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
            <li><a href="?module=satuan"> Satuan </a></li>
            <li class="active"> Ubah </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" class="form-horizontal" action="modules/rak/proses.php?act=update" method="POST">
                        <div class="box-body">

                            <input type="hidden" name="id_rak" value="<?php echo $data['id_rak']; ?>">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kode Rak</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="kode_rak" value="<?php echo $data['kode_rak']; ?>" autocomplete="off" readonly required>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-sm-2 control-label">Pilih Gudang</label>
                                <div class="col-sm-5">
                                    <select class="chosen-select" name="gudang" data-placeholder="-- Pilih Gudang --" autocomplete="off" required>
                                        <option value="<?php echo $data['id_gudang']; ?>"><?php echo $data['kode_gudang'].' - '.$data['nama_gudang']; ?></option>
                                        <?php
                                        $query_gudang = mysqli_query($mysqli, "SELECT * FROM is_gudang ORDER BY id_gudang ASC")
                                            or die('Ada kesalahan pada query tampil Gudang: ' . mysqli_error($mysqli));
                                        while ($data_gudang = mysqli_fetch_assoc($query_gudang)) {
                                            echo "<option value=\"$data_gudang[id_gudang]\"> $data_gudang[kode_gudang]  - $data_gudang[nama_gudang] </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Rak</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_rak" value="<?php echo $data['nama_rak']; ?>" autocomplete="off" required>
                                </div>
                            </div>

                        </div><!-- /.box body -->

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                    <a href="?module=rak" class="btn btn-default btn-reset">Batal</a>
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