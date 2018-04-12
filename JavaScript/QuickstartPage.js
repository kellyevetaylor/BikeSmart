"use strict"


var timerRefresh;
var date = new Date();
var hours = 0, minutes = 0, seconds = 0;
var hoursTemplate = "0", minutesTemplate = "0", secondsTemplate = "0";
var startLong, startLat;
var clickStartLat, clickStartLong;
var clickFinishLat, clickFinishLong;
var soundStart = document.getElementById("audioStart");
var soundPause = document.getElementById("audioPause");
var soundFinish = document.getElementById("audioFinish");

var interval;


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

function finishQuickstart() {
    soundFinish.play();
    setTimeout(5000);
    soundPause.pause();
    soundStart.pause();
}


function getStartLocation() {
    var myGPSElement = document.getElementById("gps");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            clickStartLat = r4(position.coords.latitude);
            clickStartLong = r4(position.coords.longitude);
        });
    } else {
        myGPSElement.innerHTML = "Geolocation is not supported.";
    }
}

function getFinishLocation() {
    stopTimer();
    var myGPSElement = document.getElementById("gps");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            clickFinishLat = r4(position.coords.latitude);
            clickFinishLong = r4(position.coords.longitude);

        });
    } else {
        myGPSElement.innerHTML = "Geolocation is not supported.";
    }
}


function startTimer() {
    soundStart.play();
    soundPause.pause();
    document.getElementById("QuickstartBtn").disabled = true;
    date.setHours(hours, minutes, seconds);
    interval= window.setInterval(autoUpdateDistance, 30 * 1000);//update the GPS every 30 seconds
    timerRefresh = setInterval(setStartTimer, 1000);
}

function setStartTimer() {
    var printSec, printMin, printHour;

    if (seconds < 59) {
        seconds += 1;

    } else if (seconds === 59) {
        minutes += 1;
        seconds = 0;
    }

    if (minutes === 59) {
        hours += 1;
        minutes = 0;
    }

    if (hours > 23) {
        hours = 0;
    }

    if (seconds < 10) {
        printSec = secondsTemplate + seconds;
    }
    else {
        printSec = seconds;
    }

    if (minutes < 10) {
        printMin = minutesTemplate + minutes;
    } else {
        printMin = minutes;
    }

    if (hours < 10) {
        printHour = hoursTemplate + hours;
    } else {
        printHour = hours;
    }


    document.getElementById("timer").innerHTML = printHour + ":" + printMin + ":" + printSec;
    document.getElementById("lbltime").value = printHour + ":" + printMin + ":" + printSec;

}


function stopTimer() {
    distanceToHub();
    document.getElementById("QuickstartBtn").disabled = false;
    soundPause.play();
    soundStart.pause();

    window.clearInterval(interval);
    window.clearInterval(timerRefresh);
}


var init = function () {
    if (navigator.geolocation) {
        getLocation();
        getStartLocation();
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


    var mapProp = {
        center: new google.maps.LatLng(long, lat),
        zoom: 17,
    };
    var centerLocation = new google.maps.LatLng(startLat, startLong);

    var marker = new google.maps.Marker({
        position: centerLocation,
        icon: "Images/BikeMarker.png",
    });


    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

    marker.setMap(map);


};

function autoUpdateDistance() {

    var origin = new google.maps.LatLng(clickStartLat, clickStartLong);

    var destination = new google.maps.LatLng(startLat, startLong);


    var service = new google.maps.DistanceMatrixService();

    service.getDistanceMatrix(
        {
            origins: [origin],
            destinations: [destination],
            travelMode: 'BICYCLING',
        },
        callback
    );

    function callback(response, status) {

        if (status == 'OK') {
            var origins = response.originAddresses;
            var destinations = response.destinationAddresses;

            for (var i = 0; i < origins.length; i++) {
                var results = response.rows[i].elements;
                for (var j = 0; j < results.length; j++) {
                    var element = results[j];
                    var distance = element.distance.text;
                    var duration = element.duration.text;
                    var from = origins[i];
                    var to = destinations[j];


                }

            }
        }
        document.getElementById("distanceTraveled").innerHTML = distance + "</br>";
        document.getElementById("lbldistance").value = distance;


    }
};

function distanceToHub() {

    var origin = new google.maps.LatLng(clickStartLat, clickStartLong);

    var destination = new google.maps.LatLng(clickFinishLat, clickFinishLong);


    var service = new google.maps.DistanceMatrixService();

    service.getDistanceMatrix(
        {
            origins: [origin],
            destinations: [destination],
            travelMode: 'BICYCLING',
        },
        callback
    );

    function callback(response, status) {

        if (status == 'OK') {
            var origins = response.originAddresses;
            var destinations = response.destinationAddresses;

            for (var i = 0; i < origins.length; i++) {
                var results = response.rows[i].elements;
                for (var j = 0; j < results.length; j++) {
                    var element = results[j];
                    var distance = element.distance.text;
                    var duration = element.duration.text;
                    var from = origins[i];
                    var to = destinations[j];


                }

            }
        }
        document.getElementById("distanceTraveled").innerHTML = distance + "</br>";
        document.getElementById("lbldistance").value = distance;


    }
};

window.addEventListener("load", init);
window.addEventListener("submit", finishQuickstart);
