var geoLocationLatInput = document.getElementById('geolocation-lat-input');
var geoLocationLongInput = document.getElementById('geolocation-long-input');

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
        return
    }

    console.log('Geolocation is not supported by this browser.')
}

function showPosition(position) {
    geoLocationLatInput.value = position.coords.latitude
    geoLocationLongInput.value = position.coords.longitude
    console.log(document.getElementById('geolocation-form'))
    document.getElementById('geolocation-form').submit()
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            console.log('User denied the request for Geolocation.')
            break;
        case error.POSITION_UNAVAILABLE:
            console.log('Location information is unavailable.')
            break;
        case error.TIMEOUT:
            console.log('The request to get user location timed out.')
            break;
        case error.UNKNOWN_ERROR:
            console.log('An unknown error occurred.')
            break;
    }
}