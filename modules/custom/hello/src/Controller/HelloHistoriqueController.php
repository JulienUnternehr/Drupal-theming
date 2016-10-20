<?php

/**
 * @file
 * Contains \Drupal\hello\Controller\HelloHistoriqueController.
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;

class HelloHistoriqueController extends ControllerBase {
    /**
     * @param NodeInterface $node
     * @return array
     */
    public function content (NodeInterface $node) {
      $node_id = $node->id();
      $node_title = $node->getTitle();

      $database = \Drupal::database();

      $id_database = $database
          ->select('hello_node_history')
          ->fields('hello_node_history', array('uid', 'update_time'))
          ->condition('nid',$node_id)
          ->execute();

      $resultat = $id_database->fetchAll();
      $nombre_resultat = count($resultat);

      $auteur_stockage = \Drupal::entityTypeManager()->getStorage('user');

      $tab = array();

      foreach ($resultat as $value) {
          $auteur = $auteur_stockage->load($value->uid);
          $date = date('d M Y G\hi', $value->update_time);
          $nom_auteur = $auteur->getAccountName();
          $tab[] = array($nom_auteur,$date);
      }
        $tableau = array(
            '#theme' => 'table',
            '#header' => array('Auteur','Date de la modification'),
            '#rows' => $tab,
    );

    $output = array(
        '#theme' => 'hello_node_history',
        '#count' => $nombre_resultat,
        '#node' => $node_title,
    );
      return array($output,$tableau);
  }
}