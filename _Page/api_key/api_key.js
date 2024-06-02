//Menampilkan Tabel Akse Pertama Kali Ketika Modal Tambah Api Key Dipilih
$('#ModalPilihAkses').on('show.bs.modal', function (e) {
    $('#MenampilkanTabelAkses').html('Loading...');
    var ProsesCariAkses = $('#ProsesCariAkses').serialize();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/TabelAkses.php',
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
        url 	    : '_Page/api_key/TabelAkses.php',
        data 	    :  ProsesCariAkses,
        success     : function(data){
            $('#MenampilkanTabelAkses').html(data);
        }
    });
});
//Kondisi Pertama kali muncul
var ProsesBatas = $('#ProsesBatas').serialize();
$('#MenampilkanTabelApiKey').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/api_key/TabelApiKey.php',
    data 	    :  ProsesBatas,
    success     : function(data){
        $('#MenampilkanTabelApiKey').html(data);
    }
});
//Merubah Jumlah Batas Data
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/TabelApiKey.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelApiKey').html(data);
        }
    });
});
//Merubah OrderBy
$('#OrderBy').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/TabelApiKey.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelApiKey').html(data);
        }
    });
});
//Merubah ShortBy
$('#ShortBy').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/TabelApiKey.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelApiKey').html(data);
        }
    });
});
//Merubah keyword_by
$('#keyword_by').change(function(){
    var keyword_by = $('#keyword_by').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/FormKeyword.php',
        data 	    :  {keyword_by: keyword_by},
        success     : function(data){
            $('#FormKeyword').html(data);
        }
    });
});
//Proses Pencarian
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/TabelApiKey.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelApiKey').html(data);
        }
    });
});
//Modal Tambah Api Key
$('#ModalTambahApiKey').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#FormTambahApiKey').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/FormTambahApiKey.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormTambahApiKey').html(data);
        }
    });
});
//Proses Tambah ApiKey
$('#ProsesTambahApiKey').submit(function(){
    $('#NotifikasiTambahApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $('#NotifikasiTambahApiKey').html('<small class="text-primary">Pastkan data yang anda input sudah benar</small>');
    var form = $('#ProsesTambahApiKey')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/ProsesTambahApiKey.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahApiKey').html(data);
            var NotifikasiTambahApiKeyBerhasil=$('#NotifikasiTambahApiKeyBerhasil').html();
            if(NotifikasiTambahApiKeyBerhasil=="Success"){
                $('#ModalTambahApiKey').modal('hide');
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelApiKey').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/api_key/TabelApiKey.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelApiKey').html(data);
                    }
                });
                swal("Good Job!", "Tambah Api Key Berhasil!", "success");
            }
        }
    });
});
//Modal Detail Api Key
$('#ModalDetailApiKey').on('show.bs.modal', function (e) {
    var id_api_key = $(e.relatedTarget).data('id');
    $('#FormDetailApiKey').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/FormDetailApiKey.php',
        data        : {id_api_key: id_api_key},
        success     : function(data){
            $('#FormDetailApiKey').html(data);
        }
    });
});
//Modal Edit Api Key
$('#ModalEditApiKey').on('show.bs.modal', function (e) {
    var id_api_key = $(e.relatedTarget).data('id');
    $('#FormEditApiKey').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/FormEditApiKey.php',
        data        : {id_api_key: id_api_key},
        success     : function(data){
            $('#FormEditApiKey').html(data);
        }
    });
    $('#NotifikasiEditAkses').html('<small class="text-primary">Pastikan data yang anda input sudah sesuai</small>');
});
//Proses Edit Api Key
$('#ProsesEditApiKey').submit(function(){
    $('#NotifikasiEditApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditApiKey')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/ProsesEditApiKey.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditApiKey').html(data);
            var NotifikasiEditApiKeyBerhasil=$('#NotifikasiEditApiKeyBerhasil').html();
            if(NotifikasiEditApiKeyBerhasil=="Success"){
                $('#ModalEditApiKey').modal('hide');
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelApiKey').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/api_key/TabelApiKey.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelApiKey').html(data);
                    }
                });
                swal("Good Job!", "Ubah Api Key Berhasil!", "success");
            }
        }
    });
});
//Modal Hapus Api Key
$('#ModalHapusApiKey').on('show.bs.modal', function (e) {
    var id_api_key = $(e.relatedTarget).data('id');
    $('#PutIdApiKey').val(id_api_key);
    $('#NotifikasiHapusApiKey').html('<span class="text-primary">Apakah anda yakin akan menghapus data Api Key ini?</span>');
});
//Proses Hapus Api Key
$('#ProsesHapusApiKey').submit(function(){
    $('#NotifikasiHapusApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusApiKey')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/api_key/ProsesHapusApiKey.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusApiKey').html(data);
            var NotifikasiHapusApiKeyBerhasil=$('#NotifikasiHapusApiKeyBerhasil').html();
            if(NotifikasiHapusApiKeyBerhasil=="Success"){
                $('#ModalHapusApiKey').modal('hide');
                var ProsesBatas = $('#ProsesBatas').serialize();
                $('#MenampilkanTabelApiKey').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/api_key/TabelApiKey.php',
                    data 	    :  ProsesBatas,
                    success     : function(data){
                        $('#MenampilkanTabelApiKey').html(data);
                    }
                });
                swal("Good Job!", "Hapus API Key Berhasil!", "success");
            }
        }
    });
});