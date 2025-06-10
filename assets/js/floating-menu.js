jQuery(document).ready(function($) {
    var scrollTrigger = 200; // Juster efter behov
    
    $(window).scroll(function() {
        if ($(window).scrollTop() > scrollTrigger) {
            $('.floating-menu-container').addClass('visible');
        } else {
            $('.floating-menu-container').removeClass('visible');
        }
    });
});