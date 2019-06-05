<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Your Next Holiday Destination</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
       .myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9));
	background:-moz-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-webkit-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-o-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-ms-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9',GradientType=0);
	background-color:#f9f9f9;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#666666;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 12px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9));
	background:-moz-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-webkit-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-o-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-ms-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9',GradientType=0);
	background-color:#e9e9e9;
}
      #map {
        height: 100%;
        width : 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      table {
        font-size: 12px;
      }
      #map {
       
        width: 840px;
         height: 410px;
           margin: auto;
      }
      div.fixed {
  position: fixed;
  
}

div.ex1 {
width: 840px;
  height: 410px;
   margin: auto;
        vertical-align: text-top;
  overflow: scroll;
}
      #listing {
        position: absolute;
        width: 0px;
        height: 700px;
        overflow: auto;
        left: 842px;
        top: 0px;
        cursor: pointer;
        overflow-x: hidden;
      }
      #findhotels {
            margin: auto;
        width: 250px;
        font-size: 14px;
        padding: 4px;
        z-index: 5;
        
      }
      #locationField {
        
        width: 250px;
        height: 25px;
         margin: auto;
        z-index: 5;
        background-color: #fff;
      }
      #controls {
        position: absolute;
        left: 300px;
        width: 140px;
        top: 0px;
        z-index: 5;
        background-color: #fff;
      }
      #autocomplete {
        width: 100%;
      }
      #country {
        width: 100%;
      }
      .placeIcon {
        width: 20px;
        height: 34px;
        margin: 4px;
      }
      .hotelIcon {
        width: 24px;
        height: 24px;
      }
       .hotelIcon1 {
        width: 24px;
        height: 24px;
      }
      #resultsTable {
       display: none;
        position: absolute;
         width: 2px;
       left: 0px;
      }
      #rating {
        font-size: 13px;
        font-family: Arial Unicode MS;
      }
      .iw_table_row {
        height: 18px;
      }
      .iw_attribute_name {
        font-weight: bold;
        text-align: right;
      }
      .iw_table_icon {
        text-align: right;
      }
    </style>
       
  <script>
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
  </script>
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/lib/animate/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="assets/css/style.css" rel="stylesheet">

  </head>

  <body>

    <!-- Header -->
    <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="https://your-next-holiday-destination-sae2018.c9users.io">Your Next Holiday Destination</a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="https://your-next-holiday-destination-sae2018.c9users.io">Home</a></li>
          <li><a href="#search">Search</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
    </header>
    <!-- #header -->

  <!-- Hero -->
  <section id="hero">
    <div class="hero-container">
      <h1>Welcome to Your Next Holiday Destination</h1>
      <h2>We find you activities, accommodation and much more around the area you'll be staying in</h2>
      <a href="#search" class="btn-get-started">Search Now</a>
    </div>
  </section><!-- #hero -->


  <main id="main">

    <!-- Search -->
    <section id="search">
      <div class="container">
        <div class="row search-container">

    <?php
 
(isset($_POST["tags"])) ? $company = $_POST["tags"] : $company=1;
 
?>

    <div id="findhotels" class="findhotels">
    
    <form  method="POST" action="index.php#map" >
  
   
    <p><FONT COLOR=black><h2>What are you looking for :</h2></p>
      <input id="tags" name="tags" style="width:200px;" value="<?php echo $_POST['tags'];?>" type="hidden">
<select name="tags">
  <option value="accounting">Accounting</option>
  <option value="airport">Airport</option>
  <option value="amusement_park">Amusement Park</option>
  <option value="aquarium">Aquarium</option>
  <option value="art_gallery">Art gallery</option>
  <option value="atm">ATM</option>
  <option value="bakery">Bakery</option>
  <option value="bank">Bank</option>
  <option value="bar">Bar</option>
  <option value="beauty_salon">Beauty Salon</option>
  <option value="bicycle_store">Bicycle Store</option>
  <option value="book_store">Book Store</option>
  <option value="bowling_alley">Bowling Alley</option>
  <option value="bus_station">Bus Station</option>
  <option value="cafe">Cafe</option>
  <option value="campground">Campground</option>
  <option value="car_dealer">Car Dealer</option>
  <option value="car_rental">Car Rental</option>
  <option value="car_repair">Car Repair</option>
  <option value="car_wash">Car Wash</option>
  <option value="casino">Casino</option>
  <option value="cemetery">Cemetery</option>
  <option value="church">Church</option>
  <option value="city_hall">City Hall</option>
  <option value="clothing_store">Clothing Store</option>
  <option value="convenience_store">Convenience Store</option>
  <option value="courthouse">Courthouse</option>
  <option value="dentist">Dentist</option>
  <option value="department_store">Department Store</option>
  <option value="doctor">Doctor</option>
  <option value="electrician">Electrician</option>
  <option value="electronics_store">Electronics Store</option>
  <option value="embassy">Embassy</option>
  <option value="fire_station">Fire Station</option>
  <option value="florist">Florist</option>
  <option value="funeral_home">Funeral Home</option>
  <option value="furniture_store">Furniture Store</option>
  <option value="gas_station">Gas Station</option>
  <option value="gym">Gym</option>
  <option value="hair_care">Hair Care</option>
  <option value="hardware_store">Hardware Store</option>
  <option value="hindu_temple">Hindu Temple</option>
  <option value="home_goods_store">Home Goods Store</option>
  <option value="hospital">Hospital</option>
  <option value="insurance_agency">Insurance Agency</option>
  <option value="jewelry_store">Jewelry Store</option>
  <option value="laundry">Laundry</option>
  <option value="lawyer">Lawyer</option>
  <option value="library">Library</option>
  <option value="liquor_store">Liquor Store</option>
  <option value="local_government_office">Local Government Office</option>
  <option value="locksmith">Locksmith</option>
  <option value="lodging">Lodging</option>
  <option value="meal_delivery">Meal Delivery</option>
  <option value="meal_takeaway">Meal Takeaway</option>
  <option value="mosque">Mosque</option>
  <option value="movie_rental">Movie Rental</option>
  <option value="movie_theater">Movie Theater</option>
  <option value="moving_company">Moving Company</option>
  <option value="museum">Museum</option>
  <option value="night_club">Night Club</option>
  <option value="painter">Painter</option>
  <option value="park">Park</option>
  <option value="parking">Parking</option>
  <option value="pet_store">Pet Store</option>
  <option value="pharmacy">Pharmacy</option>
  <option value="physiotherapist">Physiotherapist</option>
  <option value="plumber">Plumber</option>
  <option value="police">Police</option>
  <option value="post_office">Post Office</option>
  <option value="real_estate_agency">Real Estate Agency</option>
  <option value="restaurant">Restaurant</option>
  <option value="roofing_contractor">Roofing Contractor</option>
  <option value="rv_park">RV Park</option>
  <option value="school">School</option>
  <option value="shoe_store">Shoe Store</option>
  <option value="shopping_mall">Shopping Mall</option>
  <option value="spa">Spa</option>
  <option value="stadium">Stadium</option>
  <option value="storage">Storage</option>
  <option value="store">Store</option>
  <option value="subway_station">Subway Station</option>
  <option value="supermarket">Supermarket</option>
  <option value="synagogue">Synagogue</option>
  <option value="taxi_stand">Taxi Stand</option>
  <option value="train_station">Train Station</option>
  <option value="transit_station">Transit Station</option>
  <option value="travel_agency">Travel Agency</option>
  <option value="veterinary_care">Veterinary Care</option>
  <option value="zoo">Zoo</option>
</select>
     <input type="submit" name="envoi" value="Search"  id="Submit" /> 
     
    
    </form>
    <form  method="POST" action="https://your-next-holiday-destination-sae2018.c9users.io/index.php#findhotels" >
    <input type="submit" value="Reset">
    </form>
    

<?php $hi=$_POST['tags']; ?>

 
 <?php $hi=$_POST['tags']; ?>
 <?php
 $tt=0;
if (isset($_POST["tags"]))  { ?>
 

    <div><br><br><h4>In which city are you looking for <?php echo $_POST['tags'];?>:</h4></div>
    <div id="locationField">
      
      <input id="autocomplete" placeholder="Enter a city" type="text" />
    </div>

    </div>
    
  <section id="map">
    <div  id="map" class="fixed"></div>
  </section>
    
      <div id="somme1" class="ex1"></div>
    </div>
 

<?php
}


    ?>
<div id="listing">
       
      <table id="resultsTable">
        <tbody id="results"></tbody>
      </table>
    
    </div>


     <div style="display: none">
      <div id="info-content">
        <table>
        <tr id="iw-url-row" class="iw_table_row">
            <td id="iw-icon" class="iw_table_icon"></td>
            <td id="iw-url"></td>
          </tr>
          <tr id="iw-address-row" class="iw_table_row">
            <td class="iw_attribute_name">Address:</td>
            <td id="iw-address"></td>
          </tr>
          <tr id="iw-phone-row" class="iw_table_row">
            <td class="iw_attribute_name">Telephone:</td>
            <td id="iw-phone"></td>
          </tr>
          <tr id="iw-rating-row" class="iw_table_row">
            <td class="iw_attribute_name">Rating:</td>
            <td id="iw-rating"></td>
          </tr>
          <tr id="iw-website-row" class="iw_table_row">
            <td class="iw_attribute_name">Website:</td>
            <td id="iw-website"></td>
          </tr>
        </table>
      </div>
    </div>
   
    
  

    <script>


      // This example uses the autocomplete feature of the Google Places API.
      // It allows the user to find all hotels in a given place, within a given
      // country. It then displays markers for all the hotels returned,
      // with on-click details for each hotel.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

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
             
        } 
      else {
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
            fullUrl = website;
          }
          document.getElementById('iw-website-row').style.display = '';
          document.getElementById('iw-website').textContent = website;
        } else {
          document.getElementById('iw-website-row').style.display = 'none';
        }
      }
          
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeIAedIK_nUWFEhY9n49alKCbiQUashCw&libraries=places&callback=initMap"
        async defer></script>

      </div>
    </section><!-- #search -->

  </main>

<!-- Footer -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Your Next Holiday Destination</strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="assets/lib/jquery/jquery.min.js"></script>
  <script src="assets/lib/jquery/jquery-migrate.min.js"></script>
  <script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/lib/easing/easing.min.js"></script>
  <script src="assets/lib/wow/wow.min.js"></script>
  <script src="assets/lib/waypoints/waypoints.min.js"></script>
  <script src="assets/lib/counterup/counterup.min.js"></script>
  <script src="assets/lib/superfish/hoverIntent.js"></script>
  <script src="assets/lib/superfish/superfish.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="assets/js/main.js"></script>

</body>
</html>
