var nama = [];
var kelurahan = [];
var alamat = [];
var jmlpend = [];
var status_lokasi = [];
var lokasi = [];
var cords = '';
var area = [];
var peta = [];
var infoWindow;

function peta_awal(){
    var surakarta = new google.maps.LatLng(-7.578848, 110.829881);
    var petaoption = {
        zoom: 15,
        center: surakarta,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    peta = new google.maps.Map(document.getElementById("map-canvas"),petaoption);

    url = "ambildata.php";
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            var polygon;
            var cords = [];
            for(i=0;i<msg.surakarta.lahan.length;i++){
                nama[i] = msg.surakarta.lahan[i].nama_rw;
                kelurahan[i] = msg.surakarta.lahan[i].kelurahan;
                alamat[i] = msg.surakarta.lahan[i].alamat;
                jmlpend[i] = msg.surakarta.lahan[i].jmlpend;
                status_lokasi[i] = msg.surakarta.lahan[i].status;
                lokasi[i] = msg.surakarta.lahan[i].polygon;
               
                var str = lokasi[i].split(" "); 
                
                for (var j=0; j < str.length; j++) { 
                    var point = str[j].split(",");
                    cords.push(new google.maps.LatLng(parseFloat(point[0]), parseFloat(point[1])));
                }

               var contentString = '<b>RW '+nama[i]+'</b><br>' +
                                    'Alamat: '+ alamat[i] +
                                    '<br>' +
                                    'Kelurahan: '+ kelurahan[i] +
                                    '<br>' +
                                    'Jumlah Penduduk: '+ jmlpend[i] +
                                        ' Jiwa<br>' +
                                    'Status Lokasi : '+ status_lokasi[i] +
                                    '<br>';

 
                polygon = new google.maps.Polygon({
                    paths: [cords],
                    strokeColor: msg.surakarta.lahan[i].warna,
                    strokeOpacity: 0,
                    strokeWeight: 1,
                    fillColor: msg.surakarta.lahan[i].warna,
                    fillOpacity: 0.5,
                    html: contentString
                });     
                
                cords = []; 
                polygon.setMap(peta); 
                infoWindow = new google.maps.InfoWindow();
                google.maps.event.addListener(polygon, 'click', function(event) {
                    infoWindow.setContent(this.html);
                    infoWindow.setPosition(event.latLng);
                    infoWindow.open(peta);
                });
            }               
        }
    });
}

$(document).ready(function(){
    $("#search").click(function(){
        var kelurahan  = $("#kelurahan").val();
        var status     = $("#status").val();
        $.ajax({
            url: "caripeta.php",
            data: "kelurahan="+kelurahan+"&status="+status,
            dataType: 'json',
            cache: false,
            success: function(msg) {
                var surakarta2 = new google.maps.LatLng(-7.578848, 110.829881);
                var petaoption2 = {
                    zoom: 15,
                    center: surakarta2,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                var peta2 = new google.maps.Map(document.getElementById("map-canvas"),petaoption2);

                var polygon;
                var cords = [];
                for(i=0;i<msg.surakarta.lahan.length;i++){
                    nama[i] = msg.surakarta.lahan[i].nama_rw;
                    kelurahan[i] = msg.surakarta.lahan[i].kelurahan;
                    jmlpend[i] = msg.surakarta.lahan[i].jmlpend;
                    alamat[i] = msg.surakarta.lahan[i].alamat;
                    status_lokasi[i] = msg.surakarta.lahan[i].status;
                   
                    lokasi[i] = msg.surakarta.lahan[i].polygon;
                    
                    var str = lokasi[i].split(" "); 
                    
                    for (var j=0; j < str.length; j++) { 
                        var point = str[j].split(",");
                        cords.push(new google.maps.LatLng(parseFloat(point[0]), parseFloat(point[1])));
                    }

                    var contentString = '<b>RW '+nama[i]+'</b><br>' +
                                        'Alamat: '+ alamat[i] +
                                        '<br>' +
                                        'Kelurahan: '+ msg.surakarta.lahan[i].kelurahan +
                                        '<br>' +
                                       
                                        'Jumlah Penduduk: '+ jmlpend[i] +
                                        ' Jiwa<br>' +
                                        'Status Lokasi : '+ status_lokasi[i] +
                                        '<br>';
                                        
                    polygon = new google.maps.Polygon({
                        paths: [cords],
                        strokeColor: msg.surakarta.lahan[i].warna,
                        strokeOpacity: 0,
                        strokeWeight: 1,
                        fillColor: msg.surakarta.lahan[i].warna,
                        fillOpacity: 0.5,
                        html: contentString
                    });     

                    cords = [];

                    polygon.setMap(peta2); 
                    google.maps.event.addListener(polygon, 'click', function(event) {
                        infoWindow.setContent(this.html);
                        infoWindow.setPosition(event.latLng);
                        infoWindow.open(peta2);
                    });
                }
            }
        });
    });
});