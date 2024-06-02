$('#ProsesLaporan').submit(function(){
    var ProsesLaporan = $('#ProsesLaporan').serialize();
    $('#MenampilkanTabelLaporan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Laporan/TabelLaporan.php',
        data 	    :  ProsesLaporan,
        success     : function(data){
            $('#MenampilkanTabelLaporan').html(data);
        }
    });
});
//ModalCetakLaporan Muncul
$('#ModalCetakLaporan').on('show.bs.modal', function (e) {
    var periode_awal =$('#periode_awal').val();
    var periode_akhir =$('#periode_akhir').val();
    //Put Modal
    $('#PeriodeAwal').val(periode_awal);
    $('#PeriodeAkhir').val(periode_akhir);
});