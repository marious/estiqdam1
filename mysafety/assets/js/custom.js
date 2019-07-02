if ($('.wow').length) {
    new WOW().init();
}

if ($('.categories-carousel').length) {
  $('.categories-carousel, .news-carousel').owlCarousel({
    autoplay: 4000,
    items: 3,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,3],
  });
}

$('a[data-rel]').each(function() {
        $(this).attr('rel', $(this).data('rel'));
        $(".pretty-gallery a[rel^='prettyPhoto']").prettyPhoto();
    }
);
if($('.gallery').length) {
    $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto( {
            animation_speed: 'normal', theme: 'light_square', slideshow: 3000, autoplay_slideshow: true
        }
    );
    $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto( {
            animation_speed: 'fast', slideshow: 10000, hideflash: true
        }
    );
}