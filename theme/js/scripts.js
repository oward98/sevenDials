(function ($, root, undefined) {

	function render_map( $el ) {

		// vars
		var $markers = $el.find('.marker');
		var args = {
				zoom        : 16,
				center      : new google.maps.LatLng(0, 0),
				mapTypeId   : google.maps.MapTypeId.ROADMAP
		};

		// create map
		var map = new google.maps.Map( $el[0], args);

		// add a markers reference
		map.markers = [];

		// add markers
		$markers.each(function(){
				add_marker( $(this), map );
		});

		// center map
		center_map( map );

		// Turn it into a street view map
		var streetViewOptions = {
				position: map.getCenter(),
				pov: {
						heading: 150,
						pitch: 0
				}
		};
		var streetView = new google.maps.StreetViewPanorama($el[0], streetViewOptions);
		streetView.setVisible(true);
	}




	function add_marker( $marker, map ) {

		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map
		});

		// add to array
		map.markers.push( marker );

		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});

			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {

				infowindow.open( map, marker );

			});
		}

	}



	function center_map( map ) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){

			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

			bounds.extend( latlng );

		});

		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
		    map.setCenter( bounds.getCenter() );
		    map.setZoom( 16 );
		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}

	}
	function set_section_dropdown(){
		$('#section-dropdown ul li').click(function(){
			var section = $(this);
			var id = $(this).data('id');
			jQuery.post(
					ajaxurl,
					{
							'action': 'get_buildings',
							'id': id
					},
					function(response){
						console.log(response);
						if ( response != null ){
							// console.log(response[0].id);
							// console.log(response[0].name);
							// Street Dropdown
							var button_text = section.text();
							$('#section-dropdown-button').html(button_text);
							$('#section-dropdown-button').toggleClass('icons8-sort-down');
							$('#section-dropdown-button').toggleClass('icons8-sort-up');
							$('#section-dropdown').hide();

							// Section Dropdown
							var length = response.length;
							var $building;
							$('#building-dropdown ul').empty();
							for (var i = 0; i < length; i++) {
							    $building = "<a href='" + response[i].url + "'><li>" + response[i].name +"</li></a>";
									$('#building-dropdown ul').append($building);
							}

						}
						else{
							console.log('no section');
						}
				}
			);
		});
	}

	function get_building_widths(){

		var widths = [];

		widths['building'] = $('.active-building').width();
		//console.log(widths['building']);

		var margin = 0;
		var lengthPreDiv = $('.active-building').prevAll().length;
		//console.log(lengthPreDiv);
		for(i=0; i<lengthPreDiv; i++)
		{
		    margin = margin+parseInt($('.active-building').siblings().eq(i).width());
				//console.log('margin:' + margin);
		}

		widths['margin'] = margin;
		widths['total'] = 0;
		$(".todate-view").children('div').each(function(){
				widths['total'] = widths['total'] + $(this).width();
		});
		console.log(widths);

		return widths;

	}

	function set_building_margin(widths){

		widths['viewport'] = $( document ).width();

		widths['container'] = $('.section-panorama').width();
		if (typeof widths['building'] === 'undefined'){
			if (widths['total'] <= widths['container']) {
				leftMargin = (widths['container'] - widths['total'])/2;
			}
			else{
				leftMargin = 0;
			}
		}
		else{
			centrePosition = (widths['container'] - widths['building'])/2;
			//console.log(centrePosition);
			leftMargin = centrePosition - widths['margin'];
		}

		//console.log(leftMargin);

		$('.todate-view').css('margin-left',leftMargin+'px');
		$('.historic-view').css('margin-left',leftMargin+'px');

	}

	/* Set the width of the side navigation to 250px */
	function openNav() {
	    document.getElementById("sliding-nav").style.width = "320px";
			$('body').addClass('menu-open');
	}

	/* Set the width of the side navigation to 0 */
	function closeNav() {
	    document.getElementById("sliding-nav").style.width = "0";
			$('body').removeClass('menu-open');
	}
	/* Test if an element is empty */
	function isEmpty( el ){
      return !$.trim(el.html())
  }


  	/*
  	-- OW REMOVED FOLLOWING SD PILLAR REMOVAL

	function setNavHeight(){
			if($( window ).height()>(300 + 250)){
				$('.nav-content').height($( window ).height() - 250);
			}
			else{
				$('.nav-content').css('height','auto');
				$('.nav-bottom-image').css('position', 'relative');
			}
	}
	*/

	function setScrollUp(){
		var scroll = $(window).scrollTop();

		if (scroll >= 300) {
				$('.scrollup').fadeIn();
		} else {
				$('.scrollup').fadeOut();
		}
	}

	function setFooterHeight(){
		var footerheight = $('.footer').height();
		$('body').css('padding-bottom', footerheight);
	}

	$(document).ready(function(){

		'use strict';

		$('.gallery ul li span').matchHeight();
		$('.gallery ul li').matchHeight();

		//setNavHeight(); OW REMOVED FOLLOWING SD PILLAR REMOVAL
		setFooterHeight();
		setScrollUp()

		$(window).resize(function() {
				//setNavHeight();  OW REMOVED FOLLOWING SD PILLAR REMOVAL
				setFooterHeight();
		});

		$(window).scroll(function() {
				setScrollUp()
	 	});

		$('.scrollup').click(function(){
		$('html, body').animate({scrollTop : 0},1100);
		return false;
		});

		$('.breadcrumb ul li').addClass('icons8-collapse-arrow');

		/*
		* Cookie Policy
		*
		* Closes cookie policy and creates
		* a cookie to prevent further display
		*/
		$(".close-disclaimer").click(function () {
			$("#cookie-disclaimer").hide();
			function setCookie(cname, cvalue, exdays) {
				var d = new Date();
				d.setTime(d.getTime() + (exdays*24*60*60*1000));
				var expires = "expires="+ d.toUTCString();
				document.cookie = cname + "=" + cvalue + ";path=/;" + expires;
			}
			setCookie('7dials-cookie-disclaimer', $.now(), 365);
		});


		/*
		* Welcome layer
		*/
		$(".close-welcome").click(function () {
			$("#overlay-welcome").hide();
			function setCookie(cname, cvalue, exdays) {
				var d = new Date();
				d.setTime(d.getTime() + (exdays*24*60*60*1000));
				var expires = "expires="+ d.toUTCString();
				document.cookie = cname + "=" + cvalue + ";path=/;" + expires;
			}
			setCookie('7dials-cookie-welcome', $.now(), 0.2);
		});


		$('#historic-view-button').click(function(){
			$('#historic-view').slideToggle();
			$(this).toggleClass('icons8-plus');
			$(this).toggleClass('icons8-minus');
		});

		$('.acf-map').each(function(){
				// create map
				render_map( $(this) );
		});

		$('#street-dropdown-button').click(function(){
			if($('#street-dropdown').find("li").length > 0){
				$('#street-dropdown').toggle();
				$(this).toggleClass('icons8-sort-down');
				$(this).toggleClass('icons8-sort-up');
			}
		});

		$('#section-dropdown-button').click(function(){
			if($('#section-dropdown').find("li").length > 0){
				$('#section-dropdown').toggle();
				$(this).toggleClass('icons8-sort-down');
				$(this).toggleClass('icons8-sort-up');
			}
		});

		$('#building-dropdown-button').click(function(){

			if($('#building-dropdown').find("li").length > 0){
				$('#building-dropdown').toggle();
				$(this).toggleClass('icons8-sort-down');
				$(this).toggleClass('icons8-sort-up');
			}

		});

		$('#street-dropdown ul li').click(function(){
			var street = $(this);
			var id = $(this).data('id');

			jQuery.post(
			    ajaxurl,
			    {
			        'action': 'get_sections',
			        'id': id
			    },
			    function(response){
						if ( response != null ){
							// console.log(response[0].id);
							// console.log(response[0].name);
							// Street Dropdown
							var button_text = street.text();
							$('#street-dropdown-button').html(button_text);
							$('#street-dropdown-button').toggleClass('icons8-sort-down');
							$('#street-dropdown-button').toggleClass('icons8-sort-up');
							$('#street-dropdown').hide();

							// Section Dropdown
							var length = response.length;
							var $section;
							$('#section-dropdown ul').empty();
							for (var i = 0; i < length; i++) {
							    $section = "<a href='" + response[i].url + "'><li data-id='" + response[i].id + "'>" + response[i].name +"</li></a>";
									$('#section-dropdown ul').append($section);
							}
							set_section_dropdown();

						}
						else{
							console.log('no section');
						}
			        }
			);

		});
		var defaultContainerSize = parseInt($('.wrapper').css('max-width').replace(/[^-\d\.]/g, ''));

		$('.twentytwenty-container').twentytwenty();

		$('.menu-item-has-children').addClass('icons8-sort-down');

		$('.nav-button').click(function(){
			openNav();
			$('.nav-overlay').show();
		});
		$('.nav-overlay').click(function(){
			closeNav();
			$(this).hide();
		});
		$('.nav-close').click(function(){
			closeNav();
			$('.nav-overlay').hide()
		});

		$('.menu-item-has-children > a').click(function(){
			$(this).parent('li').children('ul').slideToggle();
			$(this).parent('li').toggleClass('icons8-sort-down');
			$(this).parent('li').toggleClass('icons8-sort-up');

		});

		$('.menu-item-has-children').children('ul').hide();

		var galleryItems = [];

		$('.gallery-img').each( function() {
	    var url   = $(this).data('url'),
	        width  = $(this).data('width'),
	        height = $(this).data('height'),
					caption =  $(this).data('caption');

	    var item = {
	        src : url,
	        w   : width,
	        h   : height,
					title : caption
	    }

	    galleryItems.push(item);
		});

		var $pswp = $('.pswp')[0];

		$('.gallery-img').click(function(){
			var index = $(this).data('index');
			var options = {
					index: index,
					bgOpacity: 0.7,
					showHideOpacity: true,
					shareEl: true
			}

			var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, galleryItems, options);
		  lightBox.init();
		});

	});

	$(window).on("load", function() {
		var buildingWidths = get_building_widths();

		set_building_margin(buildingWidths);

		$(window).resize(function() {
				set_building_margin(buildingWidths);
		});
	});

})(jQuery, this);
