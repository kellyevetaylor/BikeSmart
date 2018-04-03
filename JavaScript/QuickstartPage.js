"use strict"

var timerRefresh;
var date = new Date();
var hours = 0, minutes = 0, seconds = 0;
var hoursTemplate = "0", minutesTemplate = "0", secondsTemplate = "0";

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
            myGPSElement.innerHTML = "Start location: " +"<br>" +" Lat: " + r4(position.coords.latitude) + " Long: " + r4(position.coords.longitude) + "<br/>Accuracy: &plusmn; " + r0(position.coords.accuracy) + " m";
        });
    } else {
        myGPSElement.innerHTML = "Geolocation is not supported.";
    }
}

function startTimer() {



    document.getElementById("QuickstartBtn").disabled = true;
    date.setHours(hours, minutes, seconds);
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

    if(seconds <10){
        printSec= secondsTemplate + seconds;
    }
    else{
        printSec = seconds;
    }

    if(minutes < 10){
        printMin = minutesTemplate + minutes;
    }else{
        printMin = minutes;
    }

    if(hours < 10){
        printHour = hoursTemplate + hours;
    }else{
        printHour = hours;
    }


    document.getElementById("timer").innerHTML = printHour + ":" + printMin + ":" + printSec;
    document.getElementById("lbltime").value = printHour + ":" + printMin + ":" + printSec;

}



function stopTimer() {
    document.getElementById("QuickstartBtn").disabled = false;

    window.clearInterval(timerRefresh);
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
window.addEventListener("load", init);
