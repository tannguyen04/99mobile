(function ($, Drupal) {
  Drupal.behaviors.nineMobile = {
    attach: function (context, settings) {
      console.log('asds');
      $('.paragraph--carousel .paragraph__content').slick();
    }
  }
})(jQuery, Drupal);
