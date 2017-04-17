<?php

namespace Drupal\nine_mobile_product\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class NineMobileController.
 *
 * @package Drupal\nine_mobile_product\Controller
 */
class NineMobileController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello with parameter(s): $name'),
    ];
  }

}
