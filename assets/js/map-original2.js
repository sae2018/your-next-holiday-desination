var map = null;
var gmarkers = [];
var destMarkers = [];
var service = null;
var noAutoComplete = true;
var initialService = null;
var infowindow = new google.maps.InfoWindow({size: new google.maps.Size(150,50)});
    var startLoc = new google.maps.LatLng(53.002668, -2.1794); // Stoke-on-Trent, UK
    var circle = new google.maps.Circle({
        center:startLoc,
        radius:10*1609.34, // 10 miles
        strokeWeight: 2,
        strokeColor: "black",
	strokeOpacity: 0.9,
        fillColor: "red",
        fillOpacity: 0.15,
	clickable: false,
        map: map
     });

function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
  var places = [];
  for (var i = 0; i < gmarkers.length; i++) {
    gmarkers[i].setMap(null);
  }
  gmarkers = [];

  document.getElementById('side_bar').innerHTML ="<h5>found "+results.length+" places</h5>";
  for (var i = 0; i < results.length; i++) {
    var place = results[i];
    places.push(place);
    createMarker(results[i]);
  }
    
  map.fitBounds(circle.getBounds());
  // if (markers.length == 1) map.setZoom(17);
  var destArray = [];
  destMarkers = [];

  for (var i=0; i<gmarkers.length;i++){
    if (google.maps.geometry.spherical.computeDistanceBetween(startLoc, gmarkers[i].getPosition()) < 10 * 1609.34) { // 1609.34 meters/mile
       destArray.push(gmarkers[i].getPosition());
       destMarkers.push(gmarkers[i]);
    }
  }
  
  document.getElementById('info').innerHTML ="found "+destArray.length+" places within 10 miles<br>";
  var DistanceMatrixService = new google.maps.DistanceMatrixService();
  DistanceMatrixService.getDistanceMatrix(
    {
      origins: [startLoc],
      destinations: destArray,
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.IMPERIAL,
      avoidHighways: false,
      avoidTolls: false,
    }, function (response, status) {
       var distancefield = distancefield;
         if (status == google.maps.DistanceMatrixStatus.OK) {
           var origins = response.originAddresses;
           var destinations = response.destinationAddresses;
           var results = response.rows[0].elements;
           var htmlString = "<table border='1'>";
	   var within10min = 0;
           for (var r = 0; r < results.length; r++) {
               var element = results[r];
               var distancetext = element.distance.text;
               var durationtext = element.duration.text;
               var to = destinations[r];
		if (element.duration.value <= 10 * 60) {
                 htmlString += "<tr><td>"+response.originAddresses[0]+"</td><td>" +
                 "<a href='javascript:google.maps.event.trigger(destMarkers["+r+"],\"click\");'>"+to+"</a></td><td>"+distancetext+"</td><td>"+durationtext+"</td></tr>";
		 within10min++;
               }
            }//end for r
           htmlString += "</table>"; 
           document.getElementById('info').innerHTML +="found "+within10min+" within 10 minute drive<br>";

           document.getElementById('info').innerHTML += htmlString; 
         }//end if status=ok
       })//end callback

  }
}

function initialize() {
  var pyrmont = new google.maps.LatLng(-33.8665433,151.1956316);
      // If there are any parameters at eh end of the URL, they will be in  location.search
      // looking something like  "?marker=3"
 
      // skip the first character, we are not interested in the "?"
      var query = location.search.substring(1);
 
      // split the rest at each "&" character to give a list of  "argname=value"  pairs
      var pairs = query.split("&");
      for (var i=0; i<pairs.length; i++) {
        // break each pair at the first "=" to obtain the argname and value
	var pos = pairs[i].indexOf("=");
	var argname = pairs[i].substring(0,pos).toLowerCase();
        switch(argname) {
         case "q":
	  var value = pairs[i].substring(pos+1);
          break;
         default:
	  var value = pairs[i].substring(pos+1).toLowerCase();
          break;
        }
 
        // process each possible argname  -  use unescape() if theres any chance of spaces
        if (argname == "q") { 
           noAutoComplete = true;
           document.getElementById('target').value = unescape(value);
  var request = {
    bounds: circle.getBounds(), // new google.maps.LatLngBounds(new google.maps.LatLng(1.1548,103.571), new google.maps.LatLng(1.567,104.12)),

    query: unescape(value)
  };
        }
        if (argname == "lat") {lat = parseFloat(value);}
        if (argname == "lng") {lng = parseFloat(value);}
        if (argname == "zoom") {
	  zoom = parseInt(value);
	  myGeoXml3Zoom = false;
	}
        if (argname == "type") {
// from the v3 documentation 8/24/2010
// HYBRID This map type displays a transparent layer of major streets on satellite images. 
// ROADMAP This map type displays a normal street map. 
// SATELLITE This map type displays satellite images. 
// TERRAIN This map type displays maps with physical features such as terrain and vegetation. 
          if (value == "m") {maptype = google.maps.MapTypeId.ROADMAP;}
          if (value == "k") {maptype = google.maps.MapTypeId.SATELLITE;}
          if (value == "h") {maptype = google.maps.MapTypeId.HYBRID;}
          if (value == "t") {maptype = google.maps.MapTypeId.TERRAIN;}

        }
      }
  document.getElementById('target').value = "car dealerships near Stoke-on-Trent, UK";
  map = new google.maps.Map(document.getElementById('map_canvas'), {
    center: new google.maps.LatLng(40.65, -73.95), // Brooklyn, NY
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    streetViewControl: false
  });
  circle.setMap(map);
  service = new google.maps.places.PlacesService(map);
  initialService = new google.maps.places.PlacesService(map);

  google.maps.event.addListener(map, "click", function(evt) {
    startLoc = evt.latLng;
    circle.setCenter(startLoc);
    var request = {
      bounds: circle.getBounds(),
      query: document.getElementById('target').value
    };
    initialService.textSearch(request, callback);
  });


  var request = {
    bounds: new google.maps.LatLngBounds(
    new google.maps.LatLng(52.95, -2.2),
    new google.maps.LatLng(53.0, -2.0)),
    query: "car dealerships near Stoke-on-Trent, UK"
  };

  if (noAutoComplete) initialService.textSearch(request, callback);
  var defaultBounds = new google.maps.LatLngBounds(
    new google.maps.LatLng((52.95, -2.2),
    new google.maps.LatLng(53.0, -2.0))
  );
  if (request && request.bounds) map.fitBounds(request.bounds);
  else map.fitBounds(defaultBounds);

  if (!noAutoComplete) {
  var input = document.getElementById('target');
  var searchBox = new google.maps.places.SearchBox(input);
  searchBox.setBounds(defaultBounds);
  var markers = [];
  service = new google.maps.places.PlacesService(map);

  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

      }
      google.maps.event.addDomListener(window, 'load', initialize);

function createMarker(place){
    var placeLoc=place.geometry.location;
    if (place.icon) {
      var image = new google.maps.MarkerImage(
                place.icon, new google.maps.Size(71, 71),
                new google.maps.Point(0, 0), new google.maps.Point(17, 34),
                new google.maps.Size(25, 25));
     } else var image = null;

    var marker=new google.maps.Marker({
        map:map,
        icon: image,
        position:place.geometry.location
    });
    var request =  {
          reference: place.reference
    };
    google.maps.event.addListener(marker,'click',function(){
        service.getDetails(request, function(place, status) {
          if (status == google.maps.places.PlacesServiceStatus.OK) {
            var contentStr = '<h5>'+place.name+'</h5><p>'+place.formatted_address;
            if (!!place.formatted_phone_number) contentStr += '<br>'+place.formatted_phone_number;
            if (!!place.website) contentStr += '<br><a target="_blank" href="'+place.website+'">'+place.website+'</a>';
            contentStr += '<br>'+place.types+'</p>';
            infowindow.setContent(contentStr);
            infowindow.open(map,marker);
          } else { 
            var contentStr = "<h5>No Result, status="+status+"</h5>";
            infowindow.setContent(contentStr);
            infowindow.open(map,marker);
          }
        });

    });
    gmarkers.push(marker);
/*
    if (gmarkers.length==1)
    {
      map.setCenter(marker.getPosition());
      map.setZoom(19);
      google.maps.event.trigger(marker, "click");
    }
*/
    var side_bar_html = "<a href='javascript:google.maps.event.trigger(gmarkers["+parseInt(gmarkers.length-1)+"],\"click\");'>"+place.name+"</a><br>";
    document.getElementById('side_bar').innerHTML += side_bar_html;
}

