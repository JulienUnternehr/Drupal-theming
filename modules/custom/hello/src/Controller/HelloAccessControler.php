<?php

/**
 * @file
 * Contains \Drupal\hello\Controller\HelloAccessControler.
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloAccessControler extends ControllerBase
{
    public function content()
    {
        return array('#markup' => $this->t('Accès autorisé'));
    }
}