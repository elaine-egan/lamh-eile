$(window).load(function() {

  // executes when complete page is fully loaded, including all frames, objects and images
  //alert("window is loaded");

  // Sticky Nav
  // ----------------------------------------------------------------------------
  var $sticky_navigation = $('#sticky-nav-wrap');

  if( $sticky_navigation.length ) {

    // grab the initial top offset of the navigation
    //var sticky_navigation_offset_top = $('#sticky-nav-wrap').offset().top;
    var sticky_navigation_offset_top = $sticky_navigation.offset().top;

    // our function that decides wether the navigation bar should have "fixed" css position or not.
    var sticky_navigation = function(){

      var scroll_top = $(window).scrollTop(); // our current vertical position from the top

      // if we've scrolled more than the navigation, change its position to fixed to stick to top,
      // otherwise change it back to relative
      if (scroll_top > sticky_navigation_offset_top -50 ) {

        $('#sticky-nav-wrap .navbar').removeClass('navbar-static-top').addClass('navbar-fixed-top')/*.addClass('container')*/;
        $( ".wrap" ).css( "margin-top", "50px" );

      } else {

        $('#sticky-nav-wrap .navbar').removeClass('navbar-fixed-top').addClass('navbar-static-top')/*.removeClass('container')*/;
        $( ".wrap" ).css( "margin-top", "0" );

      }

    };

    // run our function on load
    sticky_navigation();

    // and run it again every time you scroll
    $(window).scroll(function() {

      sticky_navigation();

    });

  }

});
