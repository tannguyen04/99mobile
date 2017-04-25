/*jslint browser: true*/
/*global $, jQuery, Modernizr, enquire*/
(function ($, Drupal, drupalSettings) {

  'use strict';

  Drupal.behaviors.nine9Mobile = {
    attach: function (context, settings) {

      var $html = $('html'),
      mobileOnly = "screen and (max-width:47.9375em)", // 767px.
      mobileLandscape = "(min-width:30em)", // 480px.
      tablet = "(min-width:48em)"; // 768px.
      // Add  functionality here.
      $('.slider').slick({});
    }
  };

  Drupal.behaviors.equalHeight = {
    attach: function (context, settings) {
      // Equalheight navigation.
      var $jsHeightItem = $('.product--teaser');
      if($jsHeightItem.length) {
        $jsHeightItem.matchHeight();
      }
    }
  };
})(jQuery, Drupal, drupalSettings);
