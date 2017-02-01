$(document).ready(function(){
    $('.home .slider .slidethis').slick({
        infinite: true,
        speed: 7000,
        autoplay: true,
        autoplaySpeed: 0,
        cssEase: 'linear',
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: true,
        'arrows': false,
    });
});