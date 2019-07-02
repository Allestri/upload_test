// ------ Google Map & Stations API ------ //
// Test function refresh & fetch ajax.

function displayMap()
{
	var self = this;
	var gmap = null;
	var markers = [];
	
	this.initialization = function() {
		this.initMap();
		this.refreshMap();
	}
	
	// Fetch the points
	this.getPoints = function() {
		$.ajax({
	        type: "GET",
	        url: "markers.json",
	        dataType: "json",
	        success: (data)=> {
	            console.log(data[2].lat, data[2].lng);
	            console.log(data.length);
	            // Loop through each locations.
	            for(var i = 0; i < data.length; i++){
	                marker = new google.maps.Marker({
	                    position: new google.maps.LatLng(data[i].lat, data[i].lng),
	                    map: gmap
	                });
	                markers.push(marker);
	            }
	    		// Clusterer
	    		var markerCluster = new MarkerClusterer(gmap, markers,{
	    			imagePath: 'images/assets/m'
	    		});
	        },
	        error : function(result, status, error){
	            $(".container").append("<p>Erreur</p>");
	        }
	    });
	};
	
	// Init Google Map
	this.initMap = function () {
	    var crozon = {lat: 48.243982, lng: -4.432997};
	    gmap = new google.maps.Map(document.getElementById('map'), {
	          center: crozon,
	          zoom: 5
	    });
	    
	    this.getPoints();
	
	};	
	
	// Refresh the map (test)
	this.refreshMap = function () {
		$("button").click(function () {
			self.getPoints();
		});
	};	
	
}

function initApp(){
	var myMap = new displayMap();
	myMap.initialization();
}