<?php

namespace Drupal\module_test\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class moduleTestController.
 *
 * @package Drupal\module_test\Controller
 */
class moduleTestController extends ControllerBase {
  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello')
    ];
  }

}
