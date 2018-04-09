var startLong, startLat;
var labels = 'ABCD';
var labelIndex = 0;

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
            googleMap(startLat, startLong);
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


function googleMap(long, lat) {

    var hub = document.getElementById("hub").innerHTML;
    var mapProp = {
        center: new google.maps.LatLng(long, lat),
        zoom: 14
    };
    var centerLocation = new google.maps.LatLng(startLat, startLong);
    var GeorgeSquareHub = new google.maps.LatLng(55.86152450673392, -4.249251283111562);
    var LivyTowerHub = new google.maps.LatLng(55.860729730774366, -4.243202901782979);
    var GlasgowCollegeHub = new google.maps.LatLng(55.86296951227654, -4.2446405658149615);

    var GlasgowGreenHub = new google.maps.LatLng(55.849678806528196, -4.233928578959649);


    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    var marker1 = new google.maps.Marker({
        position: centerLocation,
    });

    var marker2 = new google.maps.Marker({
        position: GeorgeSquareHub,
        label: labels[labelIndex++ % labels.length],
    });

    var marker3 = new google.maps.Marker({
        position: LivyTowerHub,
        label: labels[labelIndex++ % labels.length],
    });

    var marker4 = new google.maps.Marker({
            position: GlasgowCollegeHub,
            label: labels[labelIndex++ % labels.length],
        })
    ;
    var marker5 = new google.maps.Marker({
        position: GlasgowGreenHub,
        label: labels[labelIndex++ % labels.length],

    });

    marker1.setMap(map);

    if(hub === "A"){
        marker2.setMap(map);

        var line = new google.maps.Polyline({
            path: [
                centerLocation,GeorgeSquareHub
            ],
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map: map
        });
    }else if(hub === "B"){
        marker3.setMap(map);

        var line = new google.maps.Polyline({
            path: [
                centerLocation,LivyTowerHub
            ],
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map: map
        });
    }else if(hub === "C"){
        marker4.setMap(map);

        var line = new google.maps.Polyline({
            path: [
                centerLocation,GlasgowCollegeHub
            ],
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map: map
        });
    }else if(hub === "D"){
        marker5.setMap(map);

        var line = new google.maps.Polyline({
            path: [
                centerLocation,GlasgowGreenHub
            ],
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map: map
        });
    }

};

function validation(){
    var time = document.getElementById("confirmationTime");
    var test = time.options[time.selectedIndex].value;

    if(test = "Time"){
        alert("True");
    }
}

function getTotal() {

    var time = document.getElementById("confirmationTime");
    var test = time.options[time.selectedIndex].value;
    var totalDiv = document.getElementById("total");

    if(test === "30"){
        totalDiv.innerHTML = "Total - £1";
    }else if(test === "2"){
        totalDiv.innerHTML = "Total - £4";
    }else if(test === "4"){
        totalDiv.innerHTML = "Total - £8";
    }else if(test === "24"){
        totalDiv.innerHTML = "Total - £10";
    }
}

window.addEventListener("load", init);
