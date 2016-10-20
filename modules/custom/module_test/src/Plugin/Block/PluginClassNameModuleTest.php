<?php

namespace Drupal\module_test\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'PluginClassNameModuleTest' block.
 *
 * @Block(
 *  id = "plugin_class_name_module_test",
 *  admin_label = @Translation("Plugin class name module test"),
 * )
 */
class PluginClassNameModuleTest extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['plugin_class_name_module_test']['#markup'] = 'Implement PluginClassNameModuleTest.';

    return $build;
  }

}
