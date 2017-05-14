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
      $('.slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
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
        ]
      });
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

  Drupal.behaviors.slideImage = {
    attach: function (context, settings) {
      $('.product__images__carousel').slick({
        infinite: true,
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 1
      });
    }
  };

  Drupal.behaviors.menuButton = {
    attach: function (context, settings) {
      $('.js-menu-button').click(function(){
        if($(this).hasClass("active")) {
          $(this).removeClass("active");
        }
        else {
          $(this).addClass("active");
        }
      })
    }
  };

  Drupal.behaviors.showGallery = {
    attach: function (context, settings) {
      $('.js-show-gallery').on('touchstart click', function (e) {
        $('.product__slide').toggleClass('is-active');
      });
      
      $('.js-close i').on('touchstart click', function (e) {
        $('.product__slide').toggleClass('is-active');
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
