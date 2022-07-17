$('#myOwlCarousel, #myOwlCarousel-2').owlCarousel({
    loop: true,
    dots: false,
    nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 2
        },
        372: {
            items: 2,
            nav: false
        },
        515: {
            items: 3,
            nav: false
        },
        680: {
            items: 4
        },
        1100: {
            items: 5
        }
    }
})
// WATCH
$('#myOwlCarousel, #myOwlCarousel-watch').owlCarousel({
    loop: true,
    dots: false,
    nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 2
        },
        372: {
            items: 2,
            nav: false
        },
        515: {
            items: 3,
            nav: false
        },
        680: {
            items: 4
        },
        1100: {
            items: 5
        }
    }
})

// 
$(document).ready(function () {
    var slides = $('#mySlidesShow');
    slides.owlCarousel({
        loop: true,
        items: 1,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dotsContainer: '.nav-left-bottom'
    });
    $('.list-item').on('click', function (e) {
        slides.trigger('to.owl.carousel', [$(this).index(), 500]);
    });
});





$('#mySlidesShow-rp-mb').owlCarousel({
    loop: true,
    dots: true,
    nav: false,
    items: 1,
    autoplay: true,
})