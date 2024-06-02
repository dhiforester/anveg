//Menampilkan Referenis File Pertama Kali
$('#MenampilkanTabelReferensiFile').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/File/TabelReferensiFile.php',
    success     : function(data){
        $('#MenampilkanTabelReferensiFile').html(data);
    }
});
//Modal Tambah Referensi File
$('#ModalTambahReferensiFile').on('show.bs.modal', function (e) {
    $('#NotifikasiTambahReferensiFile').html('<small><code class="text-primary">Pastikan Pengaturan Referensi Sudah Sesuai</code></small>');
});
//Proses Tambah Referensi File
$('#ProsesTambahReferensiFile').submit(function(){
    $('#NotifikasiTambahReferensiFile').html('<small><code class="text-primary">Loading...</code></small>');
    var ProsesTambahReferensiFile = $('#ProsesTambahReferensiFile').serialize();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/ProsesTambahReferensiFile.php',
        data 	    :  ProsesTambahReferensiFile,
        success     : function(data){
            $('#NotifikasiTambahReferensiFile').html(data);
            var NotifikasiTambahReferensiFileBerhasil=$('#NotifikasiTambahReferensiFileBerhasil').html();
            if(NotifikasiTambahReferensiFileBerhasil=="Success"){
                //Reset Form
                $("#ProsesTambahReferensiFile")[0].reset();
                //Tutup Modal
                $('#ModalTambahReferensiFile').modal('hide');
                //Reload Data
                $('#MenampilkanTabelReferensiFile').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/File/TabelReferensiFile.php',
                    success     : function(data){
                        $('#MenampilkanTabelReferensiFile').html(data);
                    }
                });
                //Menampilkan Swal
                swal("Good Job!", "Tambah Referensi Tipe File Berhasil!", "success");
            }
        }
    });
});
//Modal Edit Referensi File
$('#ModalEditReferensiFile').on('show.bs.modal', function (e) {
    var id_file_referensi = $(e.relatedTarget).data('id');
    $('#FormEditReferensiFile').html('<small><code class="text-primary">Pastikan Pengaturan Referensi Sudah Sesuai</code></small>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/FormEditReferensiFile.php',
        data        : {id_file_referensi: id_file_referensi},
        success     : function(data){
            $('#FormEditReferensiFile').html(data);
        }
    });
    $('#NotifikasiEditReferensiFile').html('<small><code class="text-primary">Pastikan Pengaturan Referensi Sudah Sesuai</code></small>');
});
//Proses Edit Referensi File
$('#ProsesEditReferensiFile').submit(function(){
    $('#NotifikasiEditReferensiFile').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditReferensiFile')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/ProsesEditReferensiFile.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditReferensiFile').html(data);
            var NotifikasiEditReferensiFileBerhasil=$('#NotifikasiEditReferensiFileBerhasil').html();
            if(NotifikasiEditReferensiFileBerhasil=="Success"){
                //Reset Form
                $("#ProsesEditReferensiFile")[0].reset();
                //Sembunyikan Modal
                $('#ModalEditReferensiFile').modal('hide');
                //Reload Data
                $('#MenampilkanTabelReferensiFile').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/File/TabelReferensiFile.php',
                    success     : function(data){
                        $('#MenampilkanTabelReferensiFile').html(data);
                    }
                });
                swal("Good Job!", "Edit Referensi File Berhasil!", "success");
            }
        }
    });
});
//Modal Hapus Referensi File
$('#ModalHapusReferensiFile').on('show.bs.modal', function (e) {
    var id_file_referensi = $(e.relatedTarget).data('id');
    $('#PutIdFileReferensi').val(id_file_referensi);
    $('#NotifikasiHapusReferensiFile').html('<small><code class="text-primary">Apakah anda yakin akan menghapus data ini?</code></small>');
});
//Proses Hapus Referensi File
$('#ProsesHapusReferensiFile').submit(function(){
    $('#NotifikasiHapusReferensiFile').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusReferensiFile')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/ProsesHapusReferensiFile.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusReferensiFile').html(data);
            var NotifikasiHapusReferensiFileBerhasil=$('#NotifikasiHapusReferensiFileBerhasil').html();
            if(NotifikasiHapusReferensiFileBerhasil=="Success"){
                //Reset Form
                $("#ProsesHapusReferensiFile")[0].reset();
                //Sembunyikan Modal
                $('#ModalHapusReferensiFile').modal('hide');
                //Reload Data
                $('#MenampilkanTabelReferensiFile').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/File/TabelReferensiFile.php',
                    success     : function(data){
                        $('#MenampilkanTabelReferensiFile').html(data);
                    }
                });
                swal("Good Job!", "Hapus Referensi File Berhasil!", "success");
            }
        }
    });
});
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
        url 	    : '_Page/File/TabelApiKey.php',
        data 	    :  {id_akses: id_akses},
        success     : function(data){
            $('#MenampilkanListApiKey').html(data);
        }
    });
});
//Modal List Bucket
$('#ModalPilihBucket').on('show.bs.modal', function (e) {
    var id_api_key = $(e.relatedTarget).data('id');
    $('#MenampilkanListBucket').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/TabelBucket.php',
        data 	    :  {id_api_key: id_api_key},
        success     : function(data){
            $('#MenampilkanListBucket').html(data);
        }
    });
});

//Kondisi Pertama kali muncul
var ProsesBatas = $('#ProsesBatas').serialize();
$('#MenampilkanTabelFile').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/File/TabelFile.php',
    data 	    :  ProsesBatas,
    success     : function(data){
        $('#MenampilkanTabelFile').html(data);
    }
});
//Merubah Jumlah Batas Data
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelFile').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/TabelFile.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelFile').html(data);
        }
    });
});
//Merubah OrderBy
$('#OrderBy').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelFile').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/TabelFile.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelFile').html(data);
        }
    });
});
//Merubah ShortBy
$('#ShortBy').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelFile').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/TabelFile.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelFile').html(data);
        }
    });
});
//Merubah keyword_by
$('#keyword_by').change(function(){
    var keyword_by = $('#keyword_by').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/FormKeyword.php',
        data 	    :  {keyword_by: keyword_by},
        success     : function(data){
            $('#FormKeyword').html(data);
        }
    });
});
//Proses Pencarian
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelFile').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/TabelFile.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelFile').html(data);
        }
    });
});
//Modal Tambah File
$('#ModalTambahFile').on('show.bs.modal', function (e) {
    var id_bucket = $(e.relatedTarget).data('id');
    $('#FormTambahFile').html('Loading...');
    $('#NotifikasiTambahFile').html('<small><code class="text-primary">Pastkan data yang anda input sudah benar</code></small>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/FormTambahFile.php',
        data 	    :  {id_bucket: id_bucket},
        success     : function(data){
            $('#FormTambahFile').html(data);
        }
    });
});
//Proses Tambah File
$('#ProsesTambahFile').submit(function(){
    $('#NotifikasiTambahFile').html('Loading...');
    var form = $('#ProsesTambahFile')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/ProsesTambahFile.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahFile').html(data);
            var NotifikasiTambahFileBerhasil=$('#NotifikasiTambahFileBerhasil').html();
            if(NotifikasiTambahFileBerhasil=="Success"){
                //Menutup Modal
                $('#ModalTambahFile').modal('hide');
                //Menampilkan Data
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelFile').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/File/TabelFile.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelFile').html(data);
                    }
                });
                //Menampilkan Swal
                swal("Good Job!", "Tambah File Berhasil!", "success");
            }
        }
    });
});
//Modal Detail File
$('#ModalDetailFile').on('show.bs.modal', function (e) {
    var id_file_list = $(e.relatedTarget).data('id');
    $('#FormDetailFile').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/FormDetailFile.php',
        data        : {id_file_list: id_file_list},
        success     : function(data){
            $('#FormDetailFile').html(data);
        }
    });
});
//Modal Edit File
$('#ModalEditFile').on('show.bs.modal', function (e) {
    var id_file_list = $(e.relatedTarget).data('id');
    $('#FormEditFile').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/FormEditFile.php',
        data        : {id_file_list: id_file_list},
        success     : function(data){
            $('#FormEditFile').html(data);
        }
    });
    $('#NotifikasiEditFile').html('<small><code class="text-primary">Pastikan data yang anda input sudah sesuai</code></small>');
});
//Proses Edit File
$('#ProsesEditFile').submit(function(){
    $('#NotifikasiEditFile').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditFile')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/ProsesEditFile.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditFile').html(data);
            var NotifikasiEditFileBerhasil=$('#NotifikasiEditFileBerhasil').html();
            if(NotifikasiEditFileBerhasil=="Success"){
                //Modal Edit File Ditutup
                $('#ModalEditFile').modal('hide');
                //Menampilkan Data
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelFile').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/File/TabelFile.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelFile').html(data);
                    }
                });
                //Menampilkan Swal
                swal("Good Job!", "Ubah File Berhasil!", "success");
            }
        }
    });
});
//Modal Hapus File
$('#ModalHapusFile').on('show.bs.modal', function (e) {
    var id_file_list = $(e.relatedTarget).data('id');
    $('#PutIdFile').val(id_file_list);
    $('#NotifikasiHapusFile').html('<small><code class="text-primary">Apakah anda yakin akan menghapus data File ini?</code></small>');
});
//Proses Hapus File
$('#ProsesHapusFile').submit(function(){
    $('#NotifikasiHapusFile').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusFile')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/ProsesHapusFile.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusFile').html(data);
            var NotifikasiHapusFileBerhasil=$('#NotifikasiHapusFileBerhasil').html();
            if(NotifikasiHapusFileBerhasil=="Success"){
                //Menutup Modal
                $('#ModalHapusFile').modal('hide');
                //Menampilkan List Tabel
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelFile').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/File/TabelFile.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelFile').html(data);
                    }
                });
                //Menampilkan Swal
                swal("Good Job!", "Hapus File Berhasil!", "success");
            }
        }
    });
});
//Modal Generate Link File
$('#ModalHapusFile').on('show.bs.modal', function (e) {
    var id_file_list = $(e.relatedTarget).data('id');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/File/FormGenerateLink.php',
        data 	    :  {id_file_list: id_file_list},
        success     : function(data){
            $('#FormGenerateLink').html(data);
        }
    });
});
