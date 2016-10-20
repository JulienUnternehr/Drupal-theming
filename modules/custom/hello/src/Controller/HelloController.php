<?php

/**
 * @file
 * Contains \Drupal\hello\Controller\HelloController.
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {
  public function content ($param) {
    $account = $this->currentUser();
    $account_name =  $account->getAccountName();

    if(empty($param)) {
      return array('#markup' => $this->t('Vous êtes sur la page Hello. Votre nom d\'utilisateur est ' . $account_name ));
    }

    else if(!empty($param)) {
      return array('#markup' => $this->t('Vous êtes sur la page Hello. Votre nom d\'utilisateur est ' . $account_name . ' et voici le paramètre dans l\'URL : ' . $param ));
    }

  }
}