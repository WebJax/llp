jQuery(document).ready(function ($) {
    // Copy topmenu, add a class and insert it before Hovedmenu
    $('.topmenu ul.wp-block-navigation__container').clone().addClass('mobilemenu').insertBefore('.hovedmenu ul.wp-block-navigation__container');
});