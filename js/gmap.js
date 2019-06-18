// ------ Google Map ------ //


/* function init(){
	initMap();
};
*/



function initMap() {
    //Location of Crozon
    var crozon = {lat: 48.243982, lng: -4.432997};
    //Center on Crozon
    var map = new google.maps.Map(
    document.getElementById('map'), {zoom: 10, center: crozon});
    // Marker on Crozon
    var marker = new google.maps.Marker({position: crozon, map: map});
}
