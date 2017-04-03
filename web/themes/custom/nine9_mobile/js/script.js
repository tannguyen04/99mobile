/*jslint browser: true*/
/*global $, jQuery, Modernizr, enquire*/
(function (window, document, $) {


}(this, this.document, this.jQuery));

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
})(jQuery, Drupal, drupalSettings);
