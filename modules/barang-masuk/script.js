function setStoreBarangMasuk() {
    const form = document.forms['formBarangMasuk'];
    let old_value = localStorage.getItem('barang_masuk');
    let old_data =  old_value === null ? old_value = [] : JSON.parse(old_value);

    let data = [{
        no_doc: form.elements['no_doc'].value,
        tanggal_masuk: form.elements['tanggal_masuk'].value,
        id_gudang: form.elements['id_gudang'].value,
        id_rak: form.elements['id_rak'].value,
        kode_rak: form.elements['id_rak'].selectedOptions[0].getAttribute('data-kode'),
        id_barang: form.elements['id_barang'].value,
        nama_barang: form.elements['id_barang'].selectedOptions[0].getAttribute('data-name'),
        stok: form.elements['total_stok'].value,
        jumlah_masuk: form.elements['jumlah_masuk'].value,
    }];
    let value = JSON.stringify((data.concat(old_data)).sort(function(a, b){return a - b}));

    localStorage.setItem('barang_masuk',value);
    getStoreBarangMasuk();
    form.reset();
    $('[name=id_barang]').val('').trigger('chosen:updated');
    $('[name=id_rak]').val('').trigger('chosen:updated');
    $('[name=id_gudang]').val('').trigger('chosen:updated');
}


function getStoreBarangMasuk(){
    const getData = localStorage.getItem('barang_masuk');
    const data = JSON.parse(getData);

    let html = "";
    let no = 1;
    for (let i = 0; i < data.length; i++) {
        html += `<tr>
            <td>${no++}</td>
            <td>${data[i].no_doc}</td>
            <td>${data[i].tanggal_masuk}</td>
            <td>${data[i].id_barang}</td>
            <td>${data[i].nama_barang}</td>
            <td>${data[i].kode_rak}</td>
            <td>${data[i].jumlah_masuk}</td>
            <td class="center">
                <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-danger btn-sm' href='javascript:deleteStoreBarangMasuk(${i})'>
                    <i style='color:#fff' class='glyphicon glyphicon-trash'></i>
                </a>
            </td>
        </tr>`;
    }
    document.getElementById('tbl-store').innerHTML = html;
}
setTimeout(() => {
    getStoreBarangMasuk();
}, 2000);

function deleteStoreBarangMasuk(index){
    const getData = localStorage.getItem("barang_masuk");
    const data = JSON.parse(getData);
    data.splice(index, 1);
    localStorage.setItem("barang_masuk", JSON.stringify(data));
    getStoreBarangMasuk();
}

function simpanBarangMasuk() {
    const getData = localStorage.getItem("barang_masuk");
    
    if(getData !== null){
        $.post("modules/barang-masuk/proses.php", {
            simpan: getData,
        }, function(res) {
            // console.log(res);
            localStorage.clear(); 
            window.location.replace("main.php?module=barang_masuk&alert=1");
        });
    }
    else{
        alert('Data Barang Kosong!')
    }
}

function tampil_barang(input) {
    let getData = localStorage.getItem("barang_masuk");
    let data = getData === null ? getData = [] : JSON.parse(getData);
    
    let filter = data.filter(d => d.id_barang === input.value);
    let result =  filter === null ? filter = [] : filter;
    let sum_all = result.map(item => parseInt(item.jumlah_masuk)).reduce((prev, curr) => prev + curr, 0);
    
    $.post("modules/barang-masuk/barang.php", {
        id_barang: input.value,
    }, function(res) {
        var data = JSON.parse(res);

        $('#stok').val(parseInt(data.stok) + parseInt(sum_all))
        $('#satuan').text(data.nama_satuan)

        document.getElementById('jumlah_masuk').focus();
    });
}

function cek_jumlah_masuk(input) {
    jml = document.formBarangMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
        alert('Jumlah Masuk Tidak Boleh Nol !!');
        input.value = input.value.substring(0, input.value.length - 1);
    }
}

function hitung_total_stok() {
    bil1 = document.formBarangMasuk.stok.value;
    bil2 = document.formBarangMasuk.jumlah_masuk.value;

    if (bil2 == "") {
        var hasil = "";
    } else {
        var hasil = eval(bil1) + eval(bil2);
    }

    document.formBarangMasuk.total_stok.value = (hasil);
}