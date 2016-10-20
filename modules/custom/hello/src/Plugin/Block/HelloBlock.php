<?php
/**
 * @file
 * Contains \Drupal\hello\Plugin\Block\HelloBlock.
 */

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a hello block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation ("Hello!")
 * )
 */

class Helloblock extends BlockBase {
  /**
   * Implements Drupal\Core\Block\BlokBase::build().
   */
  public function build() {
    $date = date("H\h i\m s\s");
    $markup = $this->t('Bienvenue sur notre site. Il est ' . $date);
    //return array('#markup' => $markup);

    return array(
      '#markup' => $markup,
      '#cache' => array(
        'keys' => ['HelloBlock'],
        'max-age' => '10',
      ),
    );
  }
}