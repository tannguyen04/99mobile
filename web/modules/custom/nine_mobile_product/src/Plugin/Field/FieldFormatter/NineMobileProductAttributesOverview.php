<?php

namespace Drupal\nine_mobile_product\Plugin\Field\FieldFormatter;

use Drupal\commerce_product\Plugin\Field\FieldFormatter\ProductAttributesOverview;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\commerce_product\Entity\ProductAttributeInterface;

/**
 * Plugin implementation of the 'nine_mobile_product_attributes_overview' formatter.
 *
 * @FieldFormatter(
 *   id = "nine_mobile_product_attributes_overview",
 *   label = @Translation("Nine mobile product attributes overview"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class NineMobileProductAttributesOverview extends ProductAttributesOverview {
  /**
   * Gets the renderable item list of attributes.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $variation_items
   *   The item list of variation entities.
   * @param \Drupal\commerce_product\Entity\ProductAttributeInterface $attribute
   *   The product attribute.
   *
   * @return array
   *   The render array.
   */
  protected function getAttributeItemList(FieldItemListInterface $variation_items, ProductAttributeInterface $attribute) {
    $build = [
      '#theme' => 'item_list',
      '#items' => [],
    ];

    $view_builder = $this->entityTypeManager->getViewBuilder('commerce_product_attribute_value');
    /** @var \Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem $variation */
    foreach ($variation_items as $variation) {
      /** @var \Drupal\commerce_product\Entity\ProductAttributeValueInterface $attribute_value */
      $attribute_value = $variation->entity->getAttributeValue('attribute_' . $attribute->id());
      // If this attribute value has already been added, skip.
      if (isset($build['#items'][$attribute_value->id()])) {
        continue;
      }

      $attribute_render_array = $view_builder->view($attribute_value, $this->getSetting('view_mode'));
      $attribute_build = $this->renderer->render($attribute_render_array);
      $build['#items'][$attribute_value->id()] = $attribute_build;
    }

    return $build;
  }
}
