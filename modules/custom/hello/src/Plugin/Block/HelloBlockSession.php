<?php

/**
 * @file
 * Contains \Drupal\hello\Plugin\Block\HelloBlockSession.
 */

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a hello block session.
 *
 * @Block(
 *   id = "hello_sessions",
 *   admin_label = @Translation ("Sessions Actives")
 * )
 */
class HelloBlockSession extends BlockBase {
  /**
   * Implements Drupal\Core\Block\BlokBase::build().
   */
  public function build() {
    $database = \Drupal::database();

    $session_num = $database->select('sessions','sid')
      ->fields('sid')
      ->countQuery()
      ->execute()
      ->fetchField();

    $markup = $this->t('Il y a actuellement ' . $session_num . ' sessions actives');
    return array('#markup' => $markup);
  }

  protected function blockAccess(AccountInterface $account)
  {
      if ($account->hasPermission('permission_sessions')) {
          return AccessResult::allowed();
      } else {
          return AccessResult::forbidden();
      }
  }
}