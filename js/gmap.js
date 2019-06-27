// ------ Google Map ------ //


function initMap() {
    var crozon = {lat: 48.243982, lng: -4.432997};
    var map = new google.maps.Map(document.getElementById('map'), {
          center: crozon,
          zoom: 5
    });
    var marker;
    
    $.ajax({
        type: "GET",
        url: "markers.json",
        dataType: "json",
        success: function(data) {
            console.log(data[2].lat, data[2].lng);
            console.log(data.length);
            // Loop through each locations.
            for(var i = 0; i < data.length; i++){
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(data[i].lat, data[i].lng),
                    map: map
                });
            };
        },
        error : function(result, status, error){
            $(".container").append("<p>Erreur</p>");
        }
    
    });
	$("button").click(function(){
		 $.ajax({
		        type: "GET",
		        url: "markers.json",
		        dataType: "json",
		        success: function(data) {
		            // Loop through each locations.
		            for(var i = 0; i < data.length; i++){
		                marker = new google.maps.Marker({
		                    position: new google.maps.LatLng(data[i].lat, data[i].lng),
		                    map: map
		                });
		            };
		        },
		        error : function(result, status, error){
		            $(".container").append("<p>Erreur</p>");
		        }
		    
		    }); 
	});
};

// Test Ajax
function getDatas(){
	$.ajax({
		type: 'POST',
		url: 'file.php',
		success: function(){
			alert('Ok!');
		},
		error : function(result, status, error){
			alert('Erreur');
		}
	});
};

