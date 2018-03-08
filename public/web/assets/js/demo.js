var big_image;

demo = {
    initContactUsMap: function(){

        var myLatlng = new google.maps.LatLng(44.445248, 26.099672);
        var mapOptions = {
          zoom: 14,
          center: myLatlng,
          styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}],
          scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
        }

        var map = new google.maps.Map(document.getElementById("contactUsMap"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Creative Tim Office"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);

    },

    initContactUsMap2: function(){

        var myLatlng = new google.maps.LatLng(44.445248, 26.099672);
        var mapOptions = {
          zoom: 14,
          center: myLatlng,
          styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}],
          scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
        }

        var map = new google.maps.Map(document.getElementById("contactUsMap2"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Creative Tim Office"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);

    },

    verticalDots: function(){

    	var contentSections = $('.cd-section'),
    		navigationItems = $('#cd-vertical-nav a');

    	updateNavigation();
    	$(window).on('scroll', function(){
    		updateNavigation();
    	});

    	//smooth scroll to the section
    	navigationItems.on('click', function(event){
            event.preventDefault();
            smoothScroll($(this.hash));
        });
        //smooth scroll to second section
        $('.cd-scroll-down').on('click', function(event){
            event.preventDefault();
            smoothScroll($(this.hash));
        });

        //open-close navigation on touch devices
        $('.touch .cd-nav-trigger').on('click', function(){
        	$('.touch #cd-vertical-nav').toggleClass('open');

        });
        //close navigation on touch devices when selectin an elemnt from the list
        $('.touch #cd-vertical-nav a').on('click', function(){
        	$('.touch #cd-vertical-nav').removeClass('open');
        });

    	function updateNavigation() {
    		contentSections.each(function(){
    			$this = $(this);
    			var activeSection = $('#cd-vertical-nav a[href="#'+$this.attr('id')+'"]').data('number') - 1;
    			if ( ( $this.offset().top - $(window).height()/2 < $(window).scrollTop() ) && ( $this.offset().top + $this.height() - $(window).height()/2 > $(window).scrollTop() ) ) {
    				navigationItems.eq(activeSection).addClass('is-selected');
    			}else {
    				navigationItems.eq(activeSection).removeClass('is-selected');
    			}
    		});
    	}

    	function smoothScroll(target) {
            $('body,html').animate(
            	{'scrollTop':target.offset().top},
            	600
            );
    	}
    }
}

$(document).ready(function(){

    demo.verticalDots();
});

$('a[data-scroll="true"]').click(function(e){
    var scroll_target = $(this).data('id');
    var scroll_trigger = $(this).data('scroll');

    if(scroll_trigger == true && scroll_target !== undefined){
        e.preventDefault();

        $('html, body').animate({
             scrollTop: $(scroll_target).offset().top - 50
        }, 1000);
    }

});


// onScroll animation

if( $('body').hasClass('presentation-page') ){

    $(function() {

      var $window           = $(window),
          isTouch           = Modernizr.touch;

      if (isTouch) { $('.add-animation').addClass('animated'); }

      $window.on('scroll', revealAnimation);

      function revealAnimation() {

        // Showed...
        $(".add-animation:not(.animated)").each(function () {
          var $this     = $(this),
              offsetTop = $this.offset().top,
              scrolled = $window.scrollTop(),
              win_height_padded = $window.height();
          if (scrolled + win_height_padded > offsetTop) {
              $this.addClass('animated');
          }
        });
        // Hidden...
       $(".add-animation.animated").each(function (index) {
          var $this     = $(this),
              offsetTop = $this.offset().top;
              scrolled = $window.scrollTop(),
              win_height_padded = $window.height() * 0.8;
          if (scrolled + win_height_padded < offsetTop) {
            $(this).removeClass('animated')
          }
        });
      }

      revealAnimation();
    });
}
