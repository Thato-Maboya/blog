// Define a JQuery click handler for menu icon
/* We seclect a "menu-toggle" & attach a click event on it */
/* Which means that when the user click on it the 'selector: function()' should handle it */
/* 1st define a class called ".showing" & if this class it attached to our nav-menu then the nav-menu will open
* and when we remove it the nav-menu will be closed */
/* When the user clicks on the menu-toggle select the nav-menu & toggle the class 'showing' */
// Select ".nav ul" so that it can also show dropdown when user clicks on the menu-toggle
$(document).ready(function () {
    $('.menu-toggle').on('click', function () {
        $('.nav').toggleClass('showing');
        $('.nav ul').toggleClass('showing');
    });

    /* Keep in mind that we are now disabling the "Previous" default button */
    /* Add the next & prev arrow and call the class 'next' & 'prev' respectively */
    $('.post-wrapper').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: $('.next'),
        prevArrow: $('.prev'),
        /* Copy responsive display from slick to make the carousel responsive */
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
});




