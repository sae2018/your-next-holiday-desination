$( function() {
    var availableTags = [
        "accounting",
        "airport",
        "amusement_park",
        "aquarium",
        "art_gallery",
        "atm",
        "bakery",
        "bank",
        "bar",
        "beauty_salon",
        "bicycle_store",
        "book_store",
        "bowling_alley",
        "bus_station",
        "cafe",
        "campground",
        "car_dealer",
        "car_rental",
        "car_repair",
        "car_wash",
        "casino",
        "cemetery",
        "church",
        "city_hall",
        "clothing_store",
        "convenience_store",
        "courthouse",
        "dentist",
        "department_store",
        "doctor",
        "electrician",
        "electronics_store",
        "embassy",
        "fire_station",
        "florist",
        "funeral_home",
        "furniture_store",
        "gas_station",
        "gym",
        "hair_care",
        "hardware_store",
        "hindu_temple",
        "home_goods_store",
        "hospital",
        "insurance_agency",
        "jewelry_store",
        "laundry",
        "lawyer",
        "library",
        "liquor_store",
        "local_government_office",
        "locksmith",
        "lodging",
        "meal_delivery",
        "meal_takeaway",
        "mosque",
        "movie_rental",
        "movie_theater",
        "moving_company",
        "museum",
        "night_club",
        "painter",
        "park",
        "parking",
        "pet_store",
        "pharmacy",
        "physiotherapist",
        "plumber",
        "police",
        "post_office",
        "real_estate_agency",
        "restaurant",
        "roofing_contractor",
        "rv_park",
        "school",
        "shoe_store",
        "shopping_mall",
        "spa",
        "stadium",
        "storage",
        "store",
        "subway_station",
        "supermarket",
        "synagogue",
        "taxi_stand",
        "train_station",
        "transit_station",
        "travel_agency",
        "veterinary_care",
        "zoo"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
} );


var map, places, infoWindow, infoWindow1,places1;
var markers = [];
var autocomplete;
var countryRestrict = {'country': 'us'};
var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
var hostnameRegexp = new RegExp('^https?://.+?/');

var countries = {
    'au': {
        center: {lat: -25.3, lng: 133.8},
        zoom: 4
    },
    'br': {
        center: {lat: -14.2, lng: -51.9},
        zoom: 3
    },
    'ca': {
        center: {lat: 62, lng: -110.0},
        zoom: 3
    },
    'fr': {
        center: {lat: 46.2, lng: 2.2},
        zoom: 5
    },
    'de': {
        center: {lat: 51.2, lng: 10.4},
        zoom: 5
    },
    'mx': {
        center: {lat: 23.6, lng: -102.5},
        zoom: 4
    },
    'nz': {
        center: {lat: -40.9, lng: 174.9},
        zoom: 5
    },
    'it': {
        center: {lat: 41.9, lng: 12.6},
        zoom: 5
    },
    'za': {
        center: {lat: -30.6, lng: 22.9},
        zoom: 5
    },
    'es': {
        center: {lat: 40.5, lng: -3.7},
        zoom: 5
    },
    'pt': {
        center: {lat: 39.4, lng: -8.2},
        zoom: 6
    },
    'us': {
        center: {lat: 37.1, lng: -95.7},
        zoom: 3
    },
    'uk': {
        center: {lat: 54.8, lng: -4.6},
        zoom: 5
    }
};

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: countries['us'].zoom,
      center: countries['us'].center,
      mapTypeControl: false,
      panControl: false,
      zoomControl: false,
      zoom: 2,
      streetViewControl: false
    });

infoWindow1 = new google.maps.InfoWindow;

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };

        infoWindow1.setPosition(pos);
        infoWindow1.setContent('Your location');
        infoWindow1.open(map);
        map.setZoom(8);
        map.setCenter(pos);
        onPlaceChanged1();
            
    }, function() {
        handleLocationError(true, infoWindow1, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow1, map.getCenter());
    }
      
        infoWindow = new google.maps.InfoWindow({
          content: document.getElementById('info-content')
        });

        // Create the autocomplete object and associate it with the UI input control.
        // Restrict the search to the default country, and to place type "cities".
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */ (
                document.getElementById('autocomplete')), {
                    types: ['(cities)'],
            });
        places = new google.maps.places.PlacesService(map);
          places1 = new google.maps.places.PlacesService(map);

        autocomplete.addListener('place_changed', onPlaceChanged);

        // Add a DOM event listener to react when the user selects a country.
        document.getElementById('country').addEventListener(
            'change', setAutocompleteCountry);
    }

    // When the user selects a city, get the place details for the city and
    // zoom the map in on the city.
    function onPlaceChanged() {
        var place = autocomplete.getPlace();
        
    if (place.geometry) {
        map.panTo(place.geometry.location);
        map.setZoom(8);
       
        search();
        search1();
             
    } else {
        document.getElementById('autocomplete').placeholder = 'Enter a city';
    }
}

function onPlaceChanged1() {
  
    map.setZoom(8);
    search();
    search1();
         
}

// Search for hotels in the selected city, within the viewport of the map.
function search() {
    var search = {
    bounds: map.getBounds(),
    types: ['<?php echo $hi;?>']
    };

    places.nearbySearch(search, function(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK){
            clearResults();
            clearMarkers();
           
            // Create a marker for each hotel found, and
            // assign a letter of the alphabetic to each marker icon.
            for (var i = 0; i < results.length; i++) {
              var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
              var markerIcon = MARKER_PATH + markerLetter + '.png';
              // Use marker animation to drop the icons incrementally on the map.
              markers[i] = new google.maps.Marker({
                position: results[i].geometry.location,
                animation: google.maps.Animation.DROP,
                icon: markerIcon
              });
              // If the user clicks a hotel marker, show the details of that hotel
              // in an info window.
              markers[i].placeResult = results[i];
              google.maps.event.addListener(markers[i], 'click', showInfoWindow);
              setTimeout(dropMarker(i), i * 100);
              addResult(results[i], i);
            }
          }
        });
      }
      
      function search1() {
        var search1 = {
          bounds: map.getBounds(),
          types: ['<?php echo $hi;?>']
        };

        places1.nearbySearch(search1, function(results1, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
             
             var tt = results1[0].name;
             var tt1 = '<br>' ;
            // Create a marker for each hotel found, and
            // assign a letter of the alphabetic to each marker icon.
 
var ty='';
var ty1='';
var ty2='';
var ty3='';
    for (var k = 0; k < results1.length; k++) {
        var service = new google.maps.places.PlacesService(map);
        var request = {
          placeId: results1[k].place_id,
        };
        ty3=ty3+results1[k].place_id+'<br>';
       
service.getDetails(request, function(place2, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK)   {
        ty = ty+'<img class="hotelIcon1" src="' + place2.icon +'"/>'+'<br>'+ place2.name+'<br>'+place2.vicinity+'<br>'+place2.formatted_phone_number+'<br>'+place2.website+'<br>'+'<br>'+'<br>';
       
            document.getElementById('somme1').innerHTML = ty;
        }
    });
}
       
    for (var j = 1; j < results1.length; j++) {
        tt = tt+tt1+results1[j].name; 
        document.getElementById('somme').innerHTML = tt;
 
            }
            
        }
    });
}

function clearMarkers() {
    for (var i = 0; i < markers.length; i++) {
        if (markers[i]) {
            markers[i].setMap(null);
        }
    }
    markers = [];
}

// Set the country restriction based on user input.
// Also center and zoom the map on the given country.
function setAutocompleteCountry() {
    var country = document.getElementById('country').value;
        if (country == 'all') {
          autocomplete.setComponentRestrictions({'country': []});
          map.setCenter({lat: 15, lng: 0});
          map.setZoom(2);
        } else {
          autocomplete.setComponentRestrictions({'country': country});
          map.setCenter(countries[country].center);
          map.setZoom(countries[country].zoom);
        }
        clearResults();
        clearMarkers();
      }

function dropMarker(i) {
    return function() {
      markers[i].setMap(map);
    };
  }

function addResult(result, i) {
    var results = document.getElementById('results');
    var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
    var markerIcon = MARKER_PATH + markerLetter + '.png';

    var tr = document.createElement('tr');
        tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
        tr.onclick = function() {
          google.maps.event.trigger(markers[i], 'click');
    };

    var iconTd = document.createElement('td');
    var nameTd = document.createElement('td');
    var icon = document.createElement('img');
        icon.src = markerIcon;
        icon.setAttribute('class', 'placeIcon');
        icon.setAttribute('className', 'placeIcon');
    var name = document.createTextNode(result.name);
        iconTd.appendChild(icon);
        nameTd.appendChild(name);
        tr.appendChild(iconTd);
        tr.appendChild(nameTd);
        results.appendChild(tr);
    }

function clearResults() {
    var results = document.getElementById('results');
    while (results.childNodes[0]) {
          results.removeChild(results.childNodes[0]);
    }
}

// Get the place details for a hotel. Show the information in an info window,
// anchored on the marker for the hotel that the user selected.
function showInfoWindow() {
    var marker = this;
        places.getDetails({placeId: marker.placeResult.place_id},
        function(place, status) {
              if (status !== google.maps.places.PlacesServiceStatus.OK) {
                return;
            }
            infoWindow.open(map, marker);
            buildIWContent(place);
        });
    }
      


// Load the place information into the HTML elements used by the info window.
      
function buildIWContent(place) {
    document.getElementById('iw-icon').innerHTML = '<img class="hotelIcon" ' +
        'src="' + place.icon + '"/>';
        document.getElementById('iw-url').innerHTML = '<b><a href="' + place.url +
        '">' + place.name + '</a></b>';
        document.getElementById('iw-address').textContent = place.vicinity;

        if (place.formatted_phone_number) {
          document.getElementById('iw-phone-row').style.display = '';
          document.getElementById('iw-phone').textContent =
              place.formatted_phone_number;
        } else {
          document.getElementById('iw-phone-row').style.display = 'none';
        }

// Assign a five-star rating to the hotel, using a black star ('&#10029;')
// to indicate the rating the hotel has earned, and a white star ('&#10025;')
// for the rating points not achieved.
    if (place.rating) {
      var ratingHtml = '';
          for (var i = 0; i < 5; i++) {
            if (place.rating < (i + 0.5)) {
              ratingHtml += '&#10025;';
            } else {
              ratingHtml += '&#10029;';
            }
          document.getElementById('iw-rating-row').style.display = '';
          document.getElementById('iw-rating').innerHTML = ratingHtml;
          }
        } else {
          document.getElementById('iw-rating-row').style.display = 'none';
        }

// The regexp isolates the first part of the URL (domain plus subdomain)
// to give a short URL for displaying in the info window.
if (place.website) {
  var fullUrl = place.website;
  var website = hostnameRegexp.exec(place.website);
  if (website === null) {
    website = 'http://' + place.website + '/';
    fullUrl = website
    }
        document.getElementById('iw-website-row').style.display = '';
        document.getElementById('iw-website').textContent = website;
    } else {
        document.getElementById('iw-website-row').style.display = 'none';
    }
}
