<?php

namespace Drupal\libre8_mautic\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class Libre8MauticCreateUser.
 *
 * @package Drupal\libre8_mautic\Controller
 */
class Libre8MauticCreateUser extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function CreateUser() {
    $submission = \Drupal::request()->request->get('mautic.form_on_submit');
    $message = array(
      'tan' => 'tam'
    );
    if (!empty($submission)) {
      \Drupal::logger('my_module')->error(''. print_r($submission, TRUE) .'');
    }

    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello with parameter(s): $name'),
    ];
  }

}
