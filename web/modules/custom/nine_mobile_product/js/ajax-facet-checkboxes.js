/**
 * @file
 * Handles AJAX fetching of views, including filter submission and response.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  Drupal.ajax_facets = Drupal.ajax_facets || {viewDomId: null, viewSettings: null};
  Drupal.behaviors.facetsAjaxWidget = {
    attach: function (context, drupalSettings) {
      Drupal.ajax_facets.attach(context, drupalSettings);
    }
  };

  /**
   * Trying to find DomID for our view.
   */
  Drupal.ajax_facets.attach = function (context, drupalSettings) {
    $.each(drupalSettings.views.ajaxViews, function( key, value ) {
      if (value.view_name == drupalSettings.ajaxFacets.view_name) {
        Drupal.ajax_facets.viewDomId = key;
        Drupal.ajax_facets.viewSettings = value;
      }
    });

    console.log(Drupal.ajax_facets);
  };

})(jQuery, Drupal, drupalSettings);
