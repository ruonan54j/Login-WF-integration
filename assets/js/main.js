(function($) {
  jQuery(document).ready(function() {

    // Fixed header
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      //console.log(scroll);
      if (scroll >= 50) {
        //console.log('a');
        $(".susan-header-area").addClass("shauna-header-change");
      } else {
        //console.log('a');
        $(".susan-header-area").removeClass("shauna-header-change");
      }
    });

  });
})(jQuery);

var scroll = setInterval(bannerScroll, 3000);
var ijk = 2;

function bannerScroll() {
  if (ijk == 2) {
    $(".home-mobile-banner").removeClass("banner8");
  } else if (ijk > 2) {
    var xyz = ijk - 1;
    $(".home-mobile-banner").removeClass("banner" + xyz);
  }
  $(".home-mobile-banner").addClass("banner" + ijk);
  ijk++;
  if (ijk == 9) {
    ijk = 2;
  }
}