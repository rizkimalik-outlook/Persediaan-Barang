function setStoreBarangKeluar() {
    const form = document.forms['formBarangKeluar'];
    let old_value = localStorage.getItem('barang_keluar');
    let old_data =  old_value === null ? old_value = [] : JSON.parse(old_value);

    let data = [{
        no_doc: form.elements['no_doc'].value,
        tanggal_keluar: form.elements['tanggal_keluar'].value,
        id_gudang: form.elements['id_gudang'].value,
        id_rak: form.elements['id_rak'].value,
        kode_rak: form.elements['id_rak'].selectedOptions[0].getAttribute('data-kode'),
        id_barang: form.elements['id_barang'].value,
        nama_barang: form.elements['id_barang'].selectedOptions[0].getAttribute('data-name'),
        stok: form.elements['total_stok'].value,
        jumlah_keluar: form.elements['jumlah_keluar'].value,
    }];
    let value = JSON.stringify((data.concat(old_data)).sort(function(a, b){return a - b}));

    localStorage.setItem('barang_keluar',value);
    getStoreBarangKeluar();
    form.reset();
    $('[name=id_barang]').val('').trigger('chosen:updated');
    $('[name=id_rak]').val('').trigger('chosen:updated');
    $('[name=id_gudang]').val('').trigger('chosen:updated');
}


function getStoreBarangKeluar(){
    const getData = localStorage.getItem('barang_keluar');
    const data = JSON.parse(getData);

    let html = "";
    let no = 1;
    for (let i = 0; i < data.length; i++) {
        html += `<tr>
            <td>${no++}</td>
            <td>${data[i].no_doc}</td>
            <td>${data[i].tanggal_keluar}</td>
            <td>${data[i].id_barang}</td>
            <td>${data[i].nama_barang}</td>
            <td>${data[i].kode_rak}</td>
            <td>${data[i].jumlah_keluar}</td>
            <td class="center">
                <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-danger btn-sm' href='javascript:deleteStoreBarangKeluar(${i})'>
                    <i style='color:#fff' class='glyphicon glyphicon-trash'></i>
                </a>
            </td>
        </tr>`;
    }
    document.getElementById('tbl-store').innerHTML = html;
}
setTimeout(() => {
    getStoreBarangKeluar();
}, 2000);

function deleteStoreBarangKeluar(index){
    const getData = localStorage.getItem("barang_keluar");
    const data = JSON.parse(getData);
    data.splice(index, 1);
    localStorage.setItem("barang_keluar", JSON.stringify(data));
    getStoreBarangKeluar();
}

function simpanBarangKeluar() {
    const getData = localStorage.getItem("barang_keluar");
    
    if(getData !== null){
        $.post("modules/barang-keluar/proses.php", {
            simpan: getData,
        }, function(res) {
            // console.log(res);
            localStorage.clear(); 
            window.location.replace("main.php?module=barang_keluar&alert=1");
        });
    }
    else{
        alert('Data Barang Kosong!')
    }
}

function tampil_barang(input) {
    let getData = localStorage.getItem("barang_keluar");
    let data = getData === null ? getData = [] : JSON.parse(getData);
    let filter = data.filter(d => d.id_barang === input.value);
    let result =  filter === null ? filter = [] : filter;
    let sum_all = result.map(item => parseInt(item.jumlah_keluar)).reduce((prev, curr) => prev + curr, 0);

    $.post("modules/barang-keluar/barang.php", {
        id_barang: input.value,
    }, function(res) {
        var data = JSON.parse(res);
        $('#stok').val(parseInt(data.stok) - parseInt(sum_all))
        $('#satuan').text(data.nama_satuan)
        $('[name=id_rak]').html("");
        $('[name=id_rak]').append(`<option value="${data.id_rak}" data-kode="${data.kode_rak}"> ${data.kode_rak}  - ${data.nama_rak} </option>`);
        $("[name=id_rak]").trigger("chosen:updated");

        document.getElementById('jumlah_keluar').focus();
    });
}


function change_gudang(input) {
    $.post("modules/barang-keluar/barang.php", {
        id_gudang: input.value,
    }, 
    function(res) {
        var data = JSON.parse(res);
        // var barang = document.getElementById('id_barang');

        var html = "";
        html += `<option value="">-- Pilih Barang --</option>`;
        for(var i=0; i < data.length; i++){
            html += `<option value="${data[i].id_barang}" data-name="${data[i].nama_barang}"> ${data[i].id_barang}  - ${data[i].nama_barang} </option>`;
        }
        $('[name=id_barang]').html("");
        $('[name=id_barang]').append(html);
        $('[name=id_barang]').trigger("chosen:updated");
        $('[name=id_rak]').html("<option value=''>-- Pilih Rak --</option>");
        $('[name=id_rak]').trigger("chosen:updated");
    });
}


function cek_jumlah_keluar(input) {
    jml = document.formBarangKeluar.jumlah_keluar.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
        alert('Jumlah Keluar Tidak Boleh Nol !!');
        input.value = input.value.substring(0, input.value.length - 1);
    }
}

function cek_stok(input) {
    st = document.formBarangKeluar.stok.value;
    jm = document.formBarangKeluar.jumlah_keluar.value;
    var num = input.value;
    var stk = eval(st);
    var jml = eval(jm);
    if (stk < jml) {
        alert('Stok Tidak Memenuhi, Kurangi Jumlah Barang Keluar');
        input.value = input.value.substring(0, input.value.length - 1);
    }
}

function hitung_sisa_stok() {
    bil1 = document.formBarangKeluar.stok.value;
    bil2 = document.formBarangKeluar.jumlah_keluar.value;

    if (bil2 == "") {
        var hasil = "";
    } else {
        var hasil = eval(bil1) - eval(bil2);
    }

    document.formBarangKeluar.total_stok.value = (hasil);
}

