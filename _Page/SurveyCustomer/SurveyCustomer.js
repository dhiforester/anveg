//Fungsi Menampilkan Data
function filterAndLoadTable() {
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelSurveyCustomer').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SurveyCustomer/TabelSurveyCustomer.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelSurveyCustomer').html(data);
        }
    });
}
//Menampilkan Data Pertama Kali
$(document).ready(function() {
    filterAndLoadTable();
});