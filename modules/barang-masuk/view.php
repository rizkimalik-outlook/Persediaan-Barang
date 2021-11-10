<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-sign-in icon-title"></i> Data Barang Masuk

        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Gudang
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="?module=barang_masuk">Semua Data</a></li>
                    <li class="divider"></li>
                    <?php
                    $query_gudang = mysqli_query($mysqli, "SELECT id_gudang,nama_gudang FROM is_gudang ORDER BY id_gudang ASC")
                        or die('Ada kesalahan pada query tampil Gudang: ' . mysqli_error($mysqli));
                    while ($data_gudang = mysqli_fetch_assoc($query_gudang)) {
                        echo "<li><a href='?module=barang_masuk&gudang=$data_gudang[id_gudang]'>$data_gudang[nama_gudang]</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <a class="btn btn-primary btn-social" href="?module=form_barang_masuk&form=add" title="Tambah Data" data-toggle="tooltip">
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
            // tampilkan pesan Sukses "Data Barang Masuk berhasil disimpan"
            elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Barang Masuk berhasil disimpan.
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
                                <th class="center">ID Transaksi</th>
                                <th class="center">Tanggal</th>
                                <th class="center">No Doc</th>
                                <th class="center">ID Barang</th>
                                <th class="center">Nama Barang</th>
                                <th class="center">Kode Rak</th>
                                <th class="center">Jumlah Masuk</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            if(isset($_GET['gudang'])){
                                $is_gudang = "WHERE a.id_gudang='$_GET[gudang]'";
                            }
                            else{
                                $is_gudang = "";
                            }

                            // fungsi query untuk menampilkan data dari tabel barang
                            $query = mysqli_query($mysqli, "SELECT a.id_barang_masuk,a.tanggal_masuk,a.no_doc,a.jumlah_masuk,
                                b.id_barang,b.nama_barang,
                                c.id_satuan,c.nama_satuan,
                                d.kode_rak, d.nama_rak,
                                e.kode_gudang,e.nama_gudang
                            FROM is_barang_masuk as a 
                            INNER JOIN is_barang as b 
                            INNER JOIN is_satuan as c
                            INNER JOIN is_rak as d
                            INNER JOIN is_gudang as e
                                ON a.id_barang=b.id_barang 
                                AND b.id_satuan=c.id_satuan
                                AND a.id_rak=d.id_rak
                                AND a.id_gudang=e.id_gudang
                            $is_gudang
                            ORDER BY a.id_barang_masuk DESC")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: ' . mysqli_error($mysqli));
                            

                            $no = 1;
                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                $tanggal         = $data['tanggal_masuk'];
                                $exp             = explode('-', $tanggal);
                                $tanggal_masuk   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                                // menampilkan isi tabel dari database ke tabel di aplikasi
                                echo "<tr>
                                <td width='30' class='center'>$no</td>
                                <td width='100' class='center'>$data[id_barang_masuk]</td>
                                <td width='90' class='center'>$tanggal_masuk</td>
                                <td width='80' class='center'>$data[no_doc]</td>
                                <td width='80' class='center'>$data[id_barang]</td>
                                <td width='200'>$data[nama_barang]</td>
                                <td width='80' class='center'>$data[kode_rak]</td>
                                <td width='120'>$data[jumlah_masuk] $data[nama_satuan]</td>
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