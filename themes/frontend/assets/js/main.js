jQuery(function ($) {

    $(window).load(function () {
        'use strict';
        var $portfolio_selectors = $('.trade-filter >li>a');
        var $portfolio = $('.trade-items');
        $portfolio.isotope({
            itemSelector: '.trade-item',
            layoutMode: 'fitRows'
        });

        $portfolio_selectors.on('click', function () {
            $portfolio_selectors.removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $portfolio.isotope({filter: selector});
            return false;
        });
    });
});