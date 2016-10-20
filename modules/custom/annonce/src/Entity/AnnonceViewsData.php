<?php

namespace Drupal\annonce\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Annonce entity type.
 */
class AnnonceViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {

      $data = parent::getViewsData();

      $data['annonces_consultees']['table']['group'] = 'annonce history';

      $data['annonces_consultees']['table']['base'] = array(
          'field' => 'hid',
          'title' => t('annonces_consultees'),
          'help' => t('annonces_consultees help'),
      );

      $data['annonces_consultees']['hid'] = array(
          'title' => t('hid content'),
          'help' => t('hid help'),
          'field' => array(
              'id' => 'numeric'
          )
      );

      $data['annonces_consultees']['nid'] = array(
          'title' => t('nid content'),
          'help' => t('nid help'),
          'field' => array(
              'id' => 'numeric'
          )
      );

      $data['annonces_consultees']['uid'] = array(
          'title' => t('uid content'),
          'help' => t('uid help'),
          'field' => array(
              'id' => 'numeric'
          )
      );

      $data['annonces_consultees']['date_consultation'] = array(
          'title' => t('date_consultation content'),
          'help' => t('date_consultation help'),
          'field' => array(
              'id' => 'date'
          )
      );

      $data['annonces_consultees']['nid'] = array(
          'title' => t('title nid'),
          'help' => t('help nid'),
          'relationship' => array(
              'base' => 'node_field_data',
              'base field' => 'nid',
              'id' => 'standard',
              'label' => t('label node id')
          ),
      );

      return $data;
  }
}
