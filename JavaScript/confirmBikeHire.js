var startLong, startLat;

function r0(x) {
    return Math.round(x);
}

function r2(x) {
    return Math.round(x * 100) / 100;
}

function r4(x) {
    return Math.round(x * 10000) / 10000;
}


function getLocation() {
    var myGPSElement = document.getElementById("gps");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

            startLat = r4(position.coords.latitude);
            startLong = r4(position.coords.longitude);
            googleMap(startLat,startLong) ;
        });
    } else {
        myGPSElement.innerHTML = "Geolocation is not supported.";
    }
}


var init = function () {
    if (navigator.geolocation) {
        getLocation();
        window.setInterval(getLocation, 30 * 1000);//update the GPS every 30 seconds
    }

    if ('ondeviceproximity' in window) {
        window.addEventListener('deviceproximity', function (event) {
            document.getElementById("prox").innerHTML = "Proximity:" + event.value;
        });
    }
    ;

};


function googleMap(long,lat) {


    var mapProp = {
        center:new google.maps.LatLng(long,lat),
        zoom: 17,
    };
    var centerLocation = new google.maps.LatLng(startLat,startLong);

    var marker = new google.maps.Marker({position:centerLocation,
    })


    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    marker.setMap(map);
};



function getTotal() {

  var time=  document.getElementById("")

}
window.addEventListener("load", init);
