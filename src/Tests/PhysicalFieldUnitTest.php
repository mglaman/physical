<?php

namespace Drupal\physical\Tests;

use Drupal\field\Tests\FieldUnitTestBase;

/**
 * Base class for physical field types.
 *
 * @group physical
 */
abstract class PhysicalFieldUnitTest extends FieldUnitTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('physical');

}
