$(document).ready(function() {
    $('#select-city-origin').select2({
		placeholder: "Seleccione un aeropuerto",
		allowClear: true
    });
    $('#select-city-dest').select2({
		placeholder: "Seleccione un aeropuerto",
		allowClear: true
    });

});

var Airport = {

	initialized: false,
	mobMenuFlag: false,
	wookHandler: null,
	wookOptions: null,
	scrollPos: 0,
	sendingMail: false,
	myLatlng: null,

	init: function() {
		"use strict";
		
		var $tis = this;
		
		if ($tis.initialized){
			return;
		}
		
		$tis.initialized = true;
		$tis.construct();
		$tis.events();
	},

	construct: function() {
		"use strict";
		
		var $tis = this;
		

		

	
		/**
		 * Activate placeholder in older browsers
		 */
		$('input, textarea').placeholder();
		
		/**
		 * Initialize Google Maps and populate with airport locations
		 */
		$tis.googleMap();
		
		
		/**
		 * Start NiceScroll
		 */
		$tis.startNiceScroll();

	},

	events: function() {
		"use strict";
		var $tis = this;
		
	
		/**
		 * Overlay open/close buttons
		 */
		$tis.overlayButtons();
		
		/**
		 * Check if browser is a mobile device
		 */
		$tis.isMobile();
	
		/**
		 * Capture buttons click event
		 */
		$tis.buttons();
		
	},
	


	
	googleMap: function() {
		"use strict";
		
		if ( typeof myAirports === 'undefined' || myAirports.length === 0){
			console.log('falso');
			return false;
		}
		
		var $tis = this;
		var color = "#e59292",
			hidePastEvents = false; 

		var styles = [
			{
				featureType: "transit",
				elementType: "geometry",
				stylers: [
					{ hue: color },
					{ saturation: 30 },
					{ lightness: -30},
				]
			}
		];
		
		var styledMap = new google.maps.StyledMapType(styles, {name: "Map"});
		
		$tis.myLatlng = new google.maps.LatLng(39.2746619,-103.0712411);
		
		var mapOptions = {
			center:  $tis.myLatlng,
			zoom: 5,
			scrollwheel: false,
			panControl:false,
			mapTypeControl:false,
			zoomControl:true,
			zoomControlOptions: {
				position:google.maps.ControlPosition.RIGHT_CENTER
			}
		};
		
		$tis.map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		$tis.map.mapTypes.set('map_style', styledMap);
		$tis.map.setMapTypeId('map_style');
		
		var createMarker = function(obj){
			var lat     = obj.Latitude, 
				lng     = obj.Longitude,
				name    = obj.Name,
				city    = obj.City,
				country = obj.Country,
				iata    = obj.IATA;
			
			var infowindow = new google.maps.InfoWindow({
				content: '<div class="infoWindow">' + iata + ' - '+ name+'<br>'+country+', '+city+' </div>'
			});
			
			var marker = new RichMarker({
				position: new google.maps.LatLng(lat, lng),
				map: $tis.map,
				anchorPoint: new google.maps.Point(10,-10),
				shadow: 'none',
				content: '<img src="img/AirportIcon.png" width="20px" alt="" />'
			});

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open($tis.map,marker);
			});
		};
		
		for(var i=myAirports.length-1; i >= 0; i--){
			if ( myAirports[i] == undefined ){
				continue;
			}
			
			var airport = myAirports[i];
			createMarker(airport);
			
			//$('#complete-list #list').prepend('<div class="completeInfo" data-id="' + i + '"><div class="completeDate">' + airport.Name +  '</div><div class="completeLocation">' + airport.Country + '</div></div>');
		}
		$('#complete-list #list').prepend('<div data-id="" class="completeInfo">');
	},
	


	
	startNiceScroll:function() {
		"use strict";
		
		$(document).ready(function(){
			$("html").niceScroll({
				styler:"fb",
				autohidemode:true,
				cursorcolor:"#c2c2c2",
				cursoropacitymax:"0.7",
				cursorborder:"0px solid #000",
				horizrailenabled:false,
				zindex:"1001"
			});
			
	
			
			$("#complete-list").niceScroll({
				cursorcolor:"#c2c2c2", 
				cursoropacitymax:"0.7",
				cursorborder:"0px solid #000",
				railpadding:{top:0,right:3,left:0,bottom:0},
				zindex:"999"
			});

		});
		

		
		$("#complete-list").on("mouseenter mouseleave", function(){
			$("#complete-list").getNiceScroll().resize();
		});
	},
	

	
	overlayButtons:function() {
		"use strict";
		var $tis = this;
		
		$(".open-overlay").click(function(e){
			e.preventDefault();
			
		
			
			var page = $("#" + $(this).data('overlay-id'));
			
			$tis.scrollPos = $(window).scrollTop();
			
			var transEndEventNames = {
					'WebkitTransition' : 'webkitTransitionEnd',
					'OTransition' : 'oTransitionEnd',
					'msTransition' : 'MSTransitionEnd',
					'transition' : 'transitionend'
				},
				// animation end event name
				transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ];
				
			if ( transEndEventName === undefined){
				page.addClass('moveFromBottom');
				
				$("#header, section, #footer").hide();
				$("#music-player .tracklist").getNiceScroll().hide();
					
				$('html, body').animate({scrollTop: 0}, 0);
				page.css({position:'absolute'});
			
			} else {
				page.addClass('moveFromBottom').one( transEndEventName, function() {
					$("#header, section, #footer, .nicescroll-rails").hide();
					$(".nicescroll-rails:first").show();
					$("#music-player .tracklist").getNiceScroll().hide();
					
					$('html, body').animate({scrollTop: 0}, 0);
					$(this).css({position:'absolute'});
				});
			}
			
			page.on("mouseenter mouseleave", function(){
				$("html").getNiceScroll().resize();
			});
			
		});
		
		$(".close-overlay").click(function(){
			var page = $('.page-overlay');
			
			page.css({position:'fixed'});
			
			$("#header, section, #footer, .nicescroll-rails").show();
			$("#music-player .tracklist").getNiceScroll().show();
			
			$('html, body').animate({scrollTop: $tis.scrollPos}, 0);
			
			page.removeClass('moveFromBottom');
		});
	},


	
	isMobile: function(){
		"use strict";
		
		(function(){(jQuery.browser=jQuery.browser||{}).mobile=(/android|webos|iphone|ipad|ipod|blackberry/i.test(navigator.userAgent.toLowerCase()));})(navigator.userAgent||navigator.vendor||window.opera);
	},
	

	
	buttons: function(){
		"use strict";
		var $tis = this;
		var getAirports;
		var status;
		// Capture 'See Location' Button click event.
		$("#seeLocation").click(function(e){
			e.preventDefault();
			
			this.map.setCenter(this.myLatlng);
			this.map.setZoom(11);
		});
		
		// Capture 'Complete List' Button click event.
	
		$("#complete-list-btn").click(function(){

		    	var _token = $("input[name='_token']").val();
		        $.ajax({
		            url: "/all",
		            type:'get',
		            data: {_token:_token},
		            success: function(data) {

					getAirports = data.data;
					$( "#map_canvas").addClass("load_airports");
					$("#example").html("<div  class='get_airports'><img width='30px' src='../img/progress.gif'  align='center' /></div>");
					//valido si ya se descargo la informaciond e todos los aeropuertos..
					status = $("#status-All-Airport").val(); 
				    if (status == '') {
				    	console.log('creacion del mapa');


						var createMarker = function(getAirports){
							var lat     = getAirports.Latitude, 
								lng     = getAirports.Longitude,
								name    = getAirports.Name,
								city    = getAirports.City,
								country = getAirports.Country,
								iata    = getAirports.IATA;
							
							var infowindow = new google.maps.InfoWindow({
								content: '<div class="infoWindow">' + iata + ' - '+ name+'<br>'+country+', '+city+' </div>'
							});
							
							var marker = new RichMarker({
								position: new google.maps.LatLng(lat, lng),
								map: $tis.map,
								anchorPoint: new google.maps.Point(10,-10),
								shadow: 'none',
								content: '<img src="img/AirportIcon.png" width="20px" alt="" />'
							});

							google.maps.event.addListener(marker, 'click', function() {
								infowindow.open($tis.map,marker);
							});
						};
						
						for(var i=getAirports.length-1; i >= 0; i--){
							if ( getAirports[i] == undefined ){
								continue;
							}
							
							var allAirport = getAirports[i];
							createMarker(allAirport);
							$('#list').append('<div data-id="' + i + '" class="completeInfo" ><div class="completeDate">' + allAirport.Name +  '</div><div class="completeLocation">' + allAirport.Country + '</div></div>');
							
							
						}

						$("#status-All-Airport").attr("value","true");
					}

			$('#complete-list').animate({opacity:1, height:'350px'}, 300, function(){
				$(this).addClass('enabled');
				 
				 $("#example").html("");
			});
			

			$('#airport-info, .buttons-area').toggleClass('disabled');	                
		            }
		        });


		});
		
		// Capture 'Close Complete List' click event.
		$(".close-complete-list").click(function(){
			$('#complete-list').animate({opacity:0, height:'0px'}, 300, function(){
				$(this).removeClass('enabled');
			});
			$('#airport-info, .buttons-area').toggleClass('disabled');
		});
		
		// Capture 'Complete List' Item click event.

		$("#list").delegate(".completeInfo", "click", function(){
				var id = parseInt($(this).data('id'), null);
				$tis.map.setCenter(new google.maps.LatLng(getAirports[id].Latitude, getAirports[id].Longitude-0.01));
				$tis.map.setZoom(11);
			});


		

	}
};




function initMap(lat1,lng1,lat2,lng2) {
	var $tis = this;
	var color = "#e59292";
    var pointA = new google.maps.LatLng(lat1, lng1),
        pointB = new google.maps.LatLng(lat2, lng2),
        myOptions = {
            center: pointA,
            zoom: 5,
            scrollwheel: false,
            panControl:false,
            mapTypeControl:false,
            zoomControl:true,
            zoomControlOptions: {
                position:google.maps.ControlPosition.RIGHT_CENTER
            },
        },
		styles = [

			{
				featureType: "transit",
				elementType: "geometry",
				stylers: [
					{ hue: color },
					{ saturation: 30 },
					{ lightness: -30},
				]
			}
		], 
		styledMap = new google.maps.StyledMapType(styles, {name: "Map"});
        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions),

        map.mapTypes.set('map_style', styledMap),
        map.setMapTypeId('map_style');

        // Instantiate a directions service.
        directionsService = new google.maps.DirectionsService,
        directionsDisplay = new google.maps.DirectionsRenderer({
            map: map
        }),
        markerA = new google.maps.Marker({
            position: pointA,
            title: "Origen",
            label: "A",
            map: map
        }),
        markerB = new google.maps.Marker({
            position: pointB,
            title: "Destino",
            label: "B",
            map: map
        });

    calculateRoute(directionsService, directionsDisplay, pointA, pointB);

}



function calculateRoute(directionsService, directionsDisplay, pointA, pointB) {
    directionsService.route({
        origin: pointA,
        destination: pointB,
        avoidTolls: true,
        avoidHighways: false,
        travelMode: google.maps.TravelMode.DRIVING
    }, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

