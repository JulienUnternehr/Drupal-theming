<?php

/**
 * @file
 * Contains \Drupal\hello\Controller\HelloResultatController.
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloResultatController extends ControllerBase {
  public function content ($result) {
      return array('#markup' => $this->t('Résultat : ' . $result ));
  }
}