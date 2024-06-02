//Ketika mode grafik defaul
$('#MenampilkanGrafikLog').html('Loading...');
$('#ModeGrafik').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Log/ProsesGrafikTahunan.php',
    enctype     : 'multipart/form-data',
    success     : function(data){
        var options = {
            chart: {
                height: 400,
                type: 'bar',
            },
            dataLabels: {
                enabled: false
            },
            series: [],
            title: {
                text: '',
            },
            noData: {
                text: 'Loading...'
            }
        }
        
        var chart = new ApexCharts(
            document.querySelector("#MenampilkanGrafikLog"),
            options
        );
        var UrlData = '_Page/Log/GrafikTahunan.json';
        $.getJSON(UrlData, function(response) {
            chart.updateSeries([{
                name: '',
                data: response
            }])
        });
        chart.render();
    }
});
$('#ModeGrafik').html('Riwayat Tahun Ini');
//APabila Mode Grafik Diubah
$('#TahunIni').click(function(){
    $('#MenampilkanGrafikLog').html('Loading...');
    $('#ModeGrafik').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Log/ProsesGrafikTahunan.php',
        enctype     : 'multipart/form-data',
        success     : function(data){
            var options = {
                chart: {
                    height: 400,
                    type: 'bar',
                },
                dataLabels: {
                    enabled: false
                },
                series: [],
                title: {
                    text: '',
                },
                noData: {
                    text: 'Loading...'
                }
            }
            
            var chart = new ApexCharts(
                document.querySelector("#MenampilkanGrafikLog"),
                options
            );
            var UrlData = '_Page/Log/GrafikTahunan.json';
            $.getJSON(UrlData, function(response) {
                chart.updateSeries([{
                    name: '',
                    data: response
                }])
            });
            chart.render();
        }
    });
    $('#ModeGrafik').html('Riwayat Tahun Ini');
});
$('#BulanIni').click(function(){
    $('#ModeGrafik').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Log/ProsesGrafikBulanan.php',
        enctype     : 'multipart/form-data',
        success     : function(data){
            var options = {
                chart: {
                    height: 400,
                    type: 'bar',
                },
                dataLabels: {
                    enabled: false
                },
                series: [],
                title: {
                    text: '',
                },
                noData: {
                    text: 'Loading...'
                }
            }
            
            var chart = new ApexCharts(
                document.querySelector("#MenampilkanGrafikLog"),
                options
            );
            var UrlData = '_Page/Log/GrafikBulanan.json';
            $.getJSON(UrlData, function(response) {
                chart.updateSeries([{
                    name: '',
                    data: response
                }])
            });
            chart.render();
        }
    });
    $('#ModeGrafik').html('Riwayat Bulan Ini');
});
$('#HariIni').click(function(){
    $('#ModeGrafik').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Log/ProsesGrafikHarian.php',
        enctype     : 'multipart/form-data',
        success     : function(data){
            var options = {
                chart: {
                    height: 400,
                    type: 'bar',
                },
                dataLabels: {
                    enabled: false
                },
                series: [],
                title: {
                    text: '',
                },
                noData: {
                    text: 'Loading...'
                }
            }
            
            var chart = new ApexCharts(
                document.querySelector("#MenampilkanGrafikLog"),
                options
            );
            var UrlData = '_Page/Log/GrafikHarian.json';
            $.getJSON(UrlData, function(response) {
                chart.updateSeries([{
                    name: '',
                    data: response
                }])
            });
            chart.render();
        }
    });
    $('#ModeGrafik').html('Riwayat Hari Ini');
});
//Menampilkan Data Log Default
var ProsesBatas=$('#ProsesBatas').serialize();
$('#MenampilkanTabelLog').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Log/TabelLog.php',
    data        : ProsesBatas,
    success     : function(data){
        $('#MenampilkanTabelLog').html(data);
    }
});
//Ketika Batas Diubah
$('#batas').change(function(){
    var ProsesBatas=$('#ProsesBatas').serialize();
    $('#MenampilkanTabelLog').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Log/TabelLog.php',
        data        : ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelLog').html(data);
        }
    });
});
//Ketika ShortBy Diubah
$('#ShortBy').change(function(){
    var ProsesBatas=$('#ProsesBatas').serialize();
    $('#MenampilkanTabelLog').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Log/TabelLog.php',
        data        : ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelLog').html(data);
        }
    });
});
//Ketika OrderBy Diubah
$('#OrderBy').change(function(){
    var ProsesBatas=$('#ProsesBatas').serialize();
    $('#MenampilkanTabelLog').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Log/TabelLog.php',
        data        : ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelLog').html(data);
        }
    });
});
//Ketika keyword_by Diubah
$('#keyword_by').change(function(){
    var keyword_by=$('#keyword_by').val();
    $('#FormKeyword').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Log/FormKeyword.php',
        data        : {keyword_by: keyword_by},
        success     : function(data){
            $('#FormKeyword').html(data);
        }
    });
});
//Ketika Proses Batas Dimulai
$('#ProsesBatas').submit(function(){
    var ProsesBatas=$('#ProsesBatas').serialize();
    $('#MenampilkanTabelLog').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Log/TabelLog.php',
        data        : ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelLog').html(data);
        }
    });
});