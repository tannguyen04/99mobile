/**
 * @file
 * Handles AJAX fetching of views, including filter submission and response.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';
  Drupal.behaviors.MobileProductSelectAttributes = {
    attach: function (context, drupalSettings) {
      $('.product__attributes-colors li').click(function(){
        var color_id = $(this).attr('data-color-id');
        $('.product__atributes-colors li').removeClass('active');
        $(this).attr('class', 'active');
        $('select[name="attribute_color"]').val(color_id).trigger('change');
      });

      // $('.product__attributes-memory li').click(function(){
      //   var memory_id = $(this).attr('data-memory-id');
      //   $('.product__attributes-memory li').removeClass('active');
      //   $(this).attr('class', 'active');
      //   $('select[name="attribute_memory"]').val(memory_id).trigger('change');
      // });
    }
  };

})(jQuery, Drupal, drupalSettings);
