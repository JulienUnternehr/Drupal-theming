<?php

namespace Drupal\annonce\EventSubscriber;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Events;
use Drupal\Core\Session\AccountProxy;
use \Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Database\Connection;
use Drupal\Core\Database\Database;

/**
 * Class AnnonceEventSubscriber.
 *
 * @package Drupal\annonce
 */
class AnnonceEventSubscriber implements EventSubscriberInterface {

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var Drupal\Core\Session\AccountProxy
   */
  protected $current_user;
  protected $nom_utilisateur;

  protected $current_route_match;
  protected $url_page;

  protected $database;
  /**
   * Constructor.
   */
  public function __construct(AccountProxy $current_user, CurrentRouteMatch $current_route_match, Connection $database) {
    $this->current_user = $current_user;
    $this->nom_utilisateur = $current_user->getAccountName();

    $this->current_route_match = $current_route_match;
    $this->url_page = $current_route_match->getRouteName();

    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */

    function EnregistrerBdd() {
        $database = $this->database;
        $nom_utilisateur = $this->nom_utilisateur;
        $url_page = $this->url_page;

        $nid = $this->current_route_match->getRawParameter('annonce');
        $id = $this->current_user->id();

        if ($this->url_page == 'entity.annonce.canonical') {
            $database->insert('annonces_consultees')->fields(
                array(
                    'nid' => $nid,
                    'date_consultation' => time(),
                    'uid' => $id,
                )
            )->execute();
        }
    }

    function GenerateMsg() {
        $nom_utilisateur = $this->nom_utilisateur;
        $url_page = $this->url_page;

        if (strstr($url_page, 'annonce')) {
            drupal_set_message(t( $nom_utilisateur . ', vous êtes sur une page de type ANNONCE'));
        }
    }

  static function getSubscribedEvents() {
      $events [KernelEvents::REQUEST][] = array('GenerateMsg');
      $events [KernelEvents::REQUEST][] = array('EnregistrerBdd');
    return $events;
  }
}
