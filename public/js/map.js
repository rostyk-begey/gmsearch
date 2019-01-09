'use strict'


//console.log(locations);


let map;
let tempMarker;
let inputLat = document.getElementById('latitude');
let inputLng = document.getElementById('longitude');


let resizeMap = (elem) => {
    let w = elem.parentNode.width;
    let h = elem.parentNode.height;
    elem.width = w;
    elem.height = h;
};

let latlon = [];

let showPosition = position => {
    latlon = Array(position.coords.latitude, position.coords.longitude);
    //alert(latlon[0] + "\n" + latlon[1]);
};

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}


let moveMarker = (el) =>{
    //alert(e.value)
    /*let e = {
        latLng: {
            lat(){return inputLat.value},
            lng(){return inputLng.value}
        }
    };*/
    //let position = {lat: Math.ceil(inputLat.value),lng: Math.ceil(inputLng.value)};
    let position = new google.maps.LatLng(parseFloat(inputLat.value),parseFloat(inputLng.value));
    console.warn(position);
    addTempMarker(position);
    //tempMarker.setPosition(position);
    //map.panTo(position);
};

function initMap() {

    let pos = {lat: 50.0646313999, lng: 23.4184182};

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: pos //latlon ? {lat:latlon[0],lng:latlon[1]} :
    });

    tempMarker = new google.maps.Marker({
        position: {lat: null, lng: null},
        label: "",
        icon: "",
        title: "",
        display: false,
        map: null,
        draggable: true
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
            //infoWindow.open(map);
            map.setCenter(pos);
            map.panTo(pos);
        }, () => {
            //handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        //handleLocationError(false, infoWindow, map.getCenter())
    }

    let contentString = (name,address) => {
        let content =
            '<table class="info-window" style="min-width: 100px">'+
                '<tr>'+
                    '<td style="text-align: right"><b>Name:&nbsp;</b></td>'+
                    '<td style="text-align: left">&nbsp;'+name+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td style="text-align: right"><b>Address:&nbsp;</b></td>'+
                    '<td style="text-align: left">&nbsp;'+address+'</td>'+
                '</tr>'+
            '</table>'
        ;
        return content;
    };

    let geocoder = new google.maps.Geocoder();

    map.addListener('click', function(e) {
        //clearForm();
        addTempMarker(e.latLng);
        document.getElementById('latitude').value = e.latLng.lat();
        document.getElementById('longitude').value = e.latLng.lng();
        //alert(geocodeLatLng(geocoder, this, e.latLng));
    });
    // Adding company markers to the map.
    // Note: The code uses the JavaScript Array.prototype.map() method to
    // create an array of markers based on a given "locations" array.
    // The map() method here has nothing to do with the Google Maps API.
    let iconBase = "";
    let markers = companies.map((company, i) => {
        let icon = {
            url: iconBase + company.icon, // url
            scaledSize: new google.maps.Size(40, 40), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
        return new google.maps.Marker({
            position: company.position,
            //label: company.name[0],//titles[i][0],
            icon: icon,
            title: company.name,//titles[i]
            address: company.address,
            description: company.description,
            animation: google.maps.Animation.DROP
        });
    });


    markers.forEach((marker,i)=>{
        let infowindow = new google.maps.InfoWindow({
            content: contentString(companies[i].name,companies[i].address)
        });
        marker.addListener('mouseover', function() {
            infowindow.open(map, marker);
        });
        marker.addListener('mouseout', function() {
            infowindow.close(map, marker);
        });
        marker.addListener('click', () => {
            //updateMarker(marker);
        });
    });

    // !!! ACHTUNG !!! NECESSARY !!!
    // Add a marker clusterer to manage the markers.
    let markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}

let addTempMarker = location => {
    tempMarker.setMap(map);
    map.panTo(location);
    tempMarker.setPosition(location);
    tempMarker.setAnimation(google.maps.Animation.BOUNCE);
};

let deleteTempMarker = () => {
    if(tempMarker != null){
        tempMarker.setMap(null);
    }
};

let updateMarker = (marker) => {
    deleteTempMarker();
    //alert("Test: " + marker.getPosition().lat());
    document.getElementById("imagePreview").style.backgroundImage = 'url('+ marker.icon.url +')';
    document.getElementById('form_name').innerText = "Update company";
    document.getElementById('form_submit').innerText = "Update company";
    document.getElementById('name').value = marker.getTitle();
    document.getElementById('address').value = marker['address'];
    document.getElementById('description').value = marker['description'];
    document.getElementById('latitude').value = marker.getPosition().lat();
    document.getElementById('longitude').value = marker.getPosition().lng();
};

let clearForm = () => {
    //document.getElementById("imagePreview").style.backgroundImage = 'url('+ marker.icon.url +')';
    document.getElementById('form_name').innerText = "Add company";
    document.getElementById('form_submit').innerText = "Add company";
    document.getElementById('name').value = '';
    document.getElementById('address').value = '';
    document.getElementById('description').value = '';
};

let geocodeLatLng = (geocoder, map, latLng) => {
    geocoder.geocode({'location': latLng}, (results, status) => {
        if (status === 'OK') {
            if (results[0]) {
                return results[0];
            } else {
                alert('No results found');
            }
        } else {
            alert('Geocoder failed due to: ' + status);
        }
    });
};

let geocodeAddress = (geocoder, resultsMap) => {
    let address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, (results, status) => {
        if (status === 'OK') {
            //resultsMap.setCenter(results[0].geometry.location);
            return results[0].geometry.location;
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
};