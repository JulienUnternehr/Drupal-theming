<?php

namespace Drupal\module_test\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the module_test module.
 */
class moduleTestControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "module_test moduleTestController's controller functionality",
      'description' => 'Test Unit for module module_test and controller moduleTestController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests module_test functionality.
   */
  public function testmoduleTestController() {
    // Check that the basic functions of module module_test.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
