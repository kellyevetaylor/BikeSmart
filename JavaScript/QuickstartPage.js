"use strict"
function r0(x) {return Math.round(x);}
function r2(x) {return Math.round(x*100)/100;}
function r4(x) {return Math.round(x*10000)/10000;}



function getLocation() {
    var myGPSElement = document.getElementById("gps");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
            myGPSElement.innerHTML = "Start location: Lat: " + r4(position.coords.latitude) + " Long: " + r4(position.coords.longitude)+"<br/>Accuracy: &plusmn; "+r0(position.coords.accuracy)+" m";
        });
    } else {
        myGPSElement.innerHTML = "Geolocation is not supported.";
    }
}



var init = function(){
    if (navigator.geolocation){
        getLocation();
        window.setInterval(getLocation,30*1000);//update the GPS every 30 seconds
    }

    if ('ondeviceproximity' in window){
        window.addEventListener('deviceproximity', function(event) {
            document.getElementById("prox").innerHTML = "Proximity:"+event.value;
        });
    };


};
window.addEventListener("load",init);