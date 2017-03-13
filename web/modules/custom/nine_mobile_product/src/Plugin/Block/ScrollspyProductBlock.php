<?php

namespace Drupal\nine_mobile_product\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ScrollspyProductBlock' block.
 *
 * @Block(
 *  id = "scrollspy_product_block",
 *  admin_label = @Translation("Scrollspy product block"),
 * )
 */
class ScrollspyProductBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['scrollspy_product_block']['#markup'] = 'Implement ScrollspyProductBlock.';

    return $build;
  }

}

function commerce_product_load() {
  return 'tan';
}
