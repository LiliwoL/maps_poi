document.addEventListener("DOMContentLoaded", function() {

function mapaStart()
{
    var wspolrzedne = new google.maps.LatLng(53.41935400090768,14.58160400390625);
    var opcjeMapy = {
        zoom: 10,
        center: wspolrzedne,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapa = new google.maps.Map(document.getElementById("MAPS"), opcjeMapy);
}

mapaStart();

});