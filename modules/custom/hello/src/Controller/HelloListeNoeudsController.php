<?php

/**
 * @file
 * Contains \Drupal\hello\Controller\HelloListeNoeudsController.
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;

class HelloListeNoeudsController extends ControllerBase {
  public function content ($param_list) {

    //$account = $this->currentUser();
    //$account_name =  $account->getAccountName();

    if ($param_list == 'node' || $param_list == '') {
      $storage = \Drupal::entityTypeManager()->getStorage('node');
      $ids = \Drupal::entityQuery('node')
        ->condition('type', 'article')
        ->execute();
      $entities = $storage->loadMultiple($ids);

        foreach ($entities as $objet) {
          $link = $objet->toLink();
          $table[] = $link;
        }

      $list = array(
        '#theme' => 'item_list',
        '#items' => $table,
        );

      $pager = array('#type' => 'pager');

      return array ($pager, $list);

    } elseif ($param_list != 'node') {
        return array('#markup' => $this->t('Il n\' y a pas de contenus de type : ' . $param_list ));
      }
    }

   // return array('#markup' => $this->t('Vous êtes sur la page Hello. Votre nom d\'utilisateur est ' . $account_name . ' et voici le paramètre dans l\'URL : ' . $param_list ));

}