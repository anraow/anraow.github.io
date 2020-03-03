"use strict";

// MAKE SLIDE ON MOUSEWHEEL
$('#slider').on('mousewheel', function(e, delta) {
    e.preventDefault();
    if (delta > 0) {
        $(this).carousel('prev');
    }
    else {
        $(this).carousel('next');
    }
});

// NO CAROUSEL CYCLING
$('.carousel').carousel({
    interval: 0
})

// WIDTH OF SLIDE ITEM RELATIVE OF THEIR NUM
var slideCount = $('.slide-item').length;
$(".slide-item").css('width', function(num) {
    num = 100 / slideCount;
    return num + "%";
});