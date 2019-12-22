$('#carouselExampleIndicators').on('mousewheel', function(e, delta) {
    e.preventDefault();
    if (delta > 0) {
        $(this).carousel('prev');
    }
    else {
        $(this).carousel('next');
    }
});