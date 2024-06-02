//Menampilkan Tabel Akse Pertama Kali Ketika Modal Tambah Api Key Dipilih
$('#ModalPilihAkses').on('show.bs.modal', function (e) {
    $('#MenampilkanTabelAkses').html('Loading...');
    var ProsesCariAkses = $('#ProsesCariAkses').serialize();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/TabelAkses.php',
        data 	    :  ProsesCariAkses,
        success     : function(data){
            $('#MenampilkanTabelAkses').html(data);
        }
    });
});
//Ketika Dilakukan Pencarian Akses
$('#ProsesCariAkses').change(function(){
    $('#MenampilkanTabelAkses').html('Loading...');
    var ProsesCariAkses = $('#ProsesCariAkses').serialize();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/TabelAkses.php',
        data 	    :  ProsesCariAkses,
        success     : function(data){
            $('#MenampilkanTabelAkses').html(data);
        }
    });
});
//Modal List Api Key
$('#ModalPilihApiKey').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#MenampilkanListApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/TabelApiKey.php',
        data 	    :  {id_akses: id_akses},
        success     : function(data){
            $('#MenampilkanListApiKey').html(data);
        }
    });
});
//Kondisi Pertama kali muncul
var ProsesBatas = $('#ProsesBatas').serialize();
$('#MenampilkanTabelBucket').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Bucket/TabelBucket.php',
    data 	    :  ProsesBatas,
    success     : function(data){
        $('#MenampilkanTabelBucket').html(data);
    }
});
//Merubah Jumlah Batas Data
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelBucket').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/TabelBucket.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelBucket').html(data);
        }
    });
});
//Merubah OrderBy
$('#OrderBy').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelBucket').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/TabelBucket.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelBucket').html(data);
        }
    });
});
//Merubah ShortBy
$('#ShortBy').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelBucket').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/TabelBucket.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelBucket').html(data);
        }
    });
});
//Merubah keyword_by
$('#keyword_by').change(function(){
    var keyword_by = $('#keyword_by').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/FormKeyword.php',
        data 	    :  {keyword_by: keyword_by},
        success     : function(data){
            $('#FormKeyword').html(data);
        }
    });
});
//Proses Pencarian
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelBucket').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/TabelBucket.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelBucket').html(data);
        }
    });
});
//Modal Tambah Bucket
$('#ModalTambahBucket').on('show.bs.modal', function (e) {
    var id_api_key = $(e.relatedTarget).data('id');
    $('#FormTambahBucket').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/FormTambahBucket.php',
        data        : {id_api_key: id_api_key},
        success     : function(data){
            $('#FormTambahBucket').html(data);
        }
    });
    $('#NotifikasiTambahBucket').html('<small class="text-primary">Pastkan data yang anda input sudah benar</small>');
});
//Proses Tambah Bucket
$('#ProsesTambahBucket').submit(function(){
    $('#NotifikasiTambahBucket').html('Loading...');
    var form = $('#ProsesTambahBucket')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/ProsesTambahBucket.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahBucket').html(data);
            var NotifikasiTambahBucketBerhasil=$('#NotifikasiTambahBucketBerhasil').html();
            if(NotifikasiTambahBucketBerhasil=="Success"){
                $('#ModalTambahBucket').modal('hide');
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelBucket').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Bucket/TabelBucket.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelBucket').html(data);
                    }
                });
                swal("Good Job!", "Tambah Bucket Berhasil!", "success");
            }
        }
    });
});
//Modal Detail Bucket
$('#ModalDetailBucket').on('show.bs.modal', function (e) {
    var id_bucket = $(e.relatedTarget).data('id');
    $('#FormDetailBucket').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/FormDetailBucket.php',
        data        : {id_bucket: id_bucket},
        success     : function(data){
            $('#FormDetailBucket').html(data);
        }
    });
});
//Modal Edit Api Key
$('#ModalEditBucket').on('show.bs.modal', function (e) {
    var id_bucket = $(e.relatedTarget).data('id');
    $('#FormEditBucket').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/FormEditBucket.php',
        data        : {id_bucket: id_bucket},
        success     : function(data){
            $('#FormEditBucket').html(data);
        }
    });
    $('#NotifikasiEditAkses').html('<small class="text-primary">Pastikan data yang anda input sudah sesuai</small>');
});
//Proses Edit Api Key
$('#ProsesEditBucket').submit(function(){
    $('#NotifikasiEditBucket').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditBucket')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/ProsesEditBucket.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditBucket').html(data);
            var NotifikasiEditBucketBerhasil=$('#NotifikasiEditBucketBerhasil').html();
            if(NotifikasiEditBucketBerhasil=="Success"){
                $('#ModalEditBucket').modal('hide');
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelBucket').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Bucket/TabelBucket.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelBucket').html(data);
                    }
                });
                swal("Good Job!", "Ubah Api Key Berhasil!", "success");
            }
        }
    });
});
//Modal Hapus Api Key
$('#ModalHapusBucket').on('show.bs.modal', function (e) {
    var id_bucket = $(e.relatedTarget).data('id');
    $('#PutIdBucket').val(id_bucket);
    $('#NotifikasiHapusBucket').html('<span class="text-primary">Apakah anda yakin akan menghapus data Api Key ini?</span>');
});
//Proses Hapus Api Key
$('#ProsesHapusBucket').submit(function(){
    $('#NotifikasiHapusBucket').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusBucket')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Bucket/ProsesHapusBucket.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusBucket').html(data);
            var NotifikasiHapusBucketBerhasil=$('#NotifikasiHapusBucketBerhasil').html();
            if(NotifikasiHapusBucketBerhasil=="Success"){
                $('#ModalHapusBucket').modal('hide');
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelBucket').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Bucket/TabelBucket.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelBucket').html(data);
                    }
                });
                swal("Good Job!", "Hapus Bucket Berhasil!", "success");
            }
        }
    });
});