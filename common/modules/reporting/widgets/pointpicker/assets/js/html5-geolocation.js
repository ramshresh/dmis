/**
 * Created by girc on 2/5/15.
 */
//POS_HEAD
var positiondata={latitude:'',longitude:'',accuracy:''};
localStorage['position']=undefined;
function getLocationHTML5() {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPositionHTML5);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }

}
function showPositionHTML5(position) {
    positiondata.latitude = position.coords.latitude;
    positiondata.longitude = position.coords.longitude;
    positiondata.accuracy = position.coords.accuracy;
    localStorage['positiondata'] = JSON.stringify(positiondata);
}

getLocationHTML5();

