<?php
namespace Drupal\nine_mobile_product\Plugin\facets\widget;

use Drupal\facets\FacetInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\facets\Plugin\facets\widget\LinksWidget;
use Drupal\facets\Result\ResultInterface;

/**
 * The checkbox ajax widget.
 *
 * @FacetsWidget(
 *   id = "ajax_checkboxes",
 *   label = @Translation("List of checkboxes with ajax update"),
 *   description = @Translation("A configurable widget that shows a list of checkboxes"),
 * )
 */
class AjaxCheckboxWidget extends LinksWidget {
  /**
   * {@inheritdoc}
   */
  public function build(FacetInterface $facet) {
    $build = parent::build($facet);

    $build['#attributes']['class'][] = 'js-facets-ajax-links';
    $build['#attributes']['class'][] = 'js-facets-checkbox-links';
    $build['#attached']['library'][] = 'nine_mobile_product/ajax-facet-checkboxes';
    $source_id = $facet->getFacetSourceId();
    $view_data = explode(':', $source_id);
    $build['#attached']['drupalSettings'] = [
      'ajaxFacets' => [
        'view_name' => 'product_index_',
      ],
    ];
    return $build;
  }

  /**
   * Builds a renderable array of result items.
   *
   * @param \Drupal\facets\Result\ResultInterface $result
   *   A result item.
   *
   * @return array
   *   A renderable array of the result.
   */
  protected function buildListItems(ResultInterface $result) {
    $classes = ['facet-item'];

    if ($children = $result->getChildren()) {
      $items = $this->prepareLink($result);

      $children_markup = [];
      foreach ($children as $child) {
        $children_markup[] = $this->buildChild($child);
      }

      $classes[] = 'expanded';
      $items['children'] = [$children_markup];

      if ($result->isActive()) {
        $items['#attributes'] = ['class' => 'active-trail'];
      }
    }
    else {
      $items = $this->prepareLink($result);

      if ($result->isActive()) {
        $items['#attributes'] = ['class' => 'is-active'];
      }
    }

    $items['#attributes']['data-facet-query'] = $this->facet->getUrlAlias() . ':' . $result->getRawValue();
    $items['#wrapper_attributes'] = ['class' => $classes];
    $items['#attributes']['data-drupal-facet-item-id'] = $this->facet->getUrlAlias() . '-' . $result->getRawValue();

    return $items;
  }
}
