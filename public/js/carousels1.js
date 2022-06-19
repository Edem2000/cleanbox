$(window).resize(function() {

    // $('.owl-dot').each(function(){
    //     $(this).text($(this).index()+1);
    // });
  productCommonSliderFunction();
});
$(document).ready(function(){
  productCommonSliderFunction();
    var areas_slider = $('.owl-carousel#areas-slider');
    areas_slider.owlCarousel({
        dots: true,
        items: 1,
        margin:0,
        loop: true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        lazyLoad: true,
        responsive: {
            // 0:{
            //     items: 3,
            // },
            // 1251:{
            //     items: 4,
            // },
        }
    });
    $('.areas-next').click(function() {
        areas_slider.trigger('next.owl.carousel');
    });
    $('.areas-prev').click(function() {
        areas_slider.trigger('prev.owl.carousel', [300]);
    });

    var products_slider = $('.owl-carousel#products-slider');
    products_slider.owlCarousel({
        dots: false,
        items: 1,
        // margin:0,
        loop: true,
        // autoplay:true,
        // autoplayTimeout:3000,
        // autoplayHoverPause:true,
        lazyLoad: true,
        margin: 100,
        responsive: {
            0:{
                margin: 100,
            },
            1250:{
                margin: 20,
            },
        }
    });
    $('.products-nav.next').click(function() {
        products_slider.trigger('next.owl.carousel');
    });
    $('.products-nav.prev').click(function() {
        products_slider.trigger('prev.owl.carousel', [300]);
    });

    var diplomas_slider = $('.owl-carousel#diplomas-slider');
    diplomas_slider.owlCarousel({
        dots: false,
        nav: false,
        items: 3,
        // margin:22,
        loop: true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        autoWidth:true,
        lazyLoad: true,
      margin: 20,
        responsive: {
            0:{
                items: 1,
            },
            577:{
                items: 2,
                // margin: 0,
            },
            911:{
                // items: 3,
                // margin: 0,
            },
        }
    });
    $('.diplomas-nav.next').click(function() {
        diplomas_slider.trigger('next.owl.carousel');
    });
    $('.diplomas-nav.prev').click(function() {
        diplomas_slider.trigger('prev.owl.carousel', [300]);
    });


    var blog_slider = $('.owl-carousel#blog-slider');
    blog_slider.owlCarousel({
        dots: false,
        nav: false,
        items: 3,
        margin:22,
        loop: true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        lazyLoad: true,
        responsive: {
            0:{
                items: 1,
            },
            630:{
                items: 2,
            },
            901:{
                items: 3,
            },
        }
    });


    var product_page_slider = $('.owl-carousel#product-page-slider');
    product_page_slider.owlCarousel({
        items: 1,
        margin:0,
        dots: true,
        loop: true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
    });
    $('.product-slider-forward').click(function() {
        product_slider.trigger('next.owl.carousel');
    });
    $('.product-slider-back').click(function() {
        product_slider.trigger('prev.owl.carousel', [300]);
    });


    dotcount = 1;

    $('.owl-dot').each(function() {
        $( this ).addClass( 'dotnumber' + dotcount);
        $( this ).attr('data-info', dotcount);
        dotcount=dotcount+1;
    });

    slidecount = 1;

    $('.owl-item').not('.cloned').each(function() {
        $( this ).addClass( 'slidenumber' + slidecount);
        // $(this).attr('id', slidecount);
        slidecount=slidecount+1;
    });
    $('.owl-dot').each(function() {
        grab = jQuery(this).data('info');
        slidegrab = jQuery('.slidenumber'+ grab +' img').attr('src');
        $(this).find('span').css("background-image", "url("+slidegrab+")");
    });

});

function productCommonSliderFunction() {
  var product_common_slider = $('#products-common-slider');
  if($(window).width()>940 && !product_common_slider.hasClass('started')){
    product_common_slider.addClass('owl-carousel started');
    product_common_slider.owlCarousel({
      items: 3,
      margin:0,
      dots: true,
      loop: true,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
    });
  }
  else if($(window).width()<=940){
    // product_common_slider.removeClass('owl-carousel slider');
    product_common_slider.trigger('destroy.owl.carousel').removeClass('started');
  }
}
