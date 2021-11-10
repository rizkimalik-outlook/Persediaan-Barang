<script src="modules/barang-keluar/script.js"></script>
<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') {
?>
    <!-- tampilan form add data -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Input Data Barang Keluar
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
            <li><a href="?module=barang_keluar"> Barang Keluar </a></li>
            <li class="active"> Tambah </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <!-- <form role="form" class="form-horizontal" action="modules/barang-keluar/proses.php?act=insert" method="POST" name="formBarangKeluar"> -->
                    <form role="form" class="form-horizontal" action="javascript:setStoreBarangKeluar();" method="POST" name="formBarangKeluar">
                        <div class="box-body">
                            <?php
                            // fungsi untuk membuat no doc
                            $query_id = mysqli_query($mysqli, "SELECT RIGHT(no_doc,5) as kode FROM is_barang_keluar
                                                ORDER BY id_barang_keluar DESC LIMIT 1")
                                or die('Ada kesalahan pada query tampil no_doc : ' . mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);

                            if ($count <> 0) {
                                // mengambil data no_doc
                                $data_id = mysqli_fetch_assoc($query_id);
                                $kode    = $data_id['kode'] + 1;
                            } else {
                                $kode = 1;
                            }

                            $tahun           = date("Y");
                            $bulan           = date("m");
                            $buat_id         = str_pad($kode, 5, "0", STR_PAD_LEFT);
                            $no_doc = "BK-$tahun-$bulan-$buat_id";
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">No Doc</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="no_doc" value="<?php echo $no_doc; ?>" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Pilih Gudang</label>
                                <div class="col-sm-5">
                                    <select class="chosen-select" name="id_gudang" data-placeholder="-- Pilih Gudang --" onchange="change_gudang(this)" autocomplete="off" required>
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
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Barang</label>
                                <div class="col-sm-2">
                                    <select class="chosen-select" name="id_barang" data-placeholder="-- Pilih Barang --" onchange="tampil_barang(this)" autocomplete="off" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <label class="col-sm-1 control-label">Rak</label>
                                <div class="col-sm-2">
                                    <select class="chosen-select form-control" name="id_rak" data-placeholder="-- Pilih Rak --" onchange="" autocomplete="off" required readonly>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Stok</label>
                                <div class="col-sm-5">
                                    <div class='input-group'>
                                        <input type='text' class='form-control' id='stok' name='stok' value='0' readonly required>
                                        <span class='input-group-addon' id="satuan">satuan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Jumlah Keluar</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="jumlah_keluar" name="jumlah_keluar" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="cek_jumlah_keluar(this)&cek_stok(this)&hitung_sisa_stok(this)" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Total Stok</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="total_stok" name="total_stok" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-4">
                                    <button type="submit" class="btn btn-primary" name="tambah">Tambah Barang</button>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-offset-10 col-sm-2">
                                            <button type="button" class="btn btn-primary btn-submit" name="simpan" onclick="simpanBarangKeluar()">Simpan</button>
                                            <a href="?module=barang_keluar" class="btn btn-default btn-reset">Batal</a>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-striped table-hover" name="tbl-store">
                                        <thead>
                                            <tr>
                                                <th class="center bg-primary">No.</th>
                                                <th class="center bg-primary">No Doc</th>
                                                <th class="center bg-primary">Tanggal</th>
                                                <th class="center bg-primary">ID Barang</th>
                                                <th class="center bg-primary">Nama Barang</th>
                                                <th class="center bg-primary">Kode Rak</th>
                                                <th class="center bg-primary">Jumlah Keluar</th>
                                                <th class="center bg-primary">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-store"></tbody>
                                    </table>
                                </div>
                            </div>

                        </div><!-- /.box body -->

                        <!-- <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                    <a href="?module=barang_keluar" class="btn btn-default btn-reset">Batal</a>
                                </div>
                            </div>
                        </div> -->
                        <!-- /.box footer -->
                    </form>
                </div><!-- /.box -->
            </div>
            <!--/.col -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
<?php
}
?>