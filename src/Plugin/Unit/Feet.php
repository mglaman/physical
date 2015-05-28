<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\Feet.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Feet.
 *
 * @Unit(
 *   id = "feet",
 *   label = @Translation("Feet"),
 *   unit = "ft",
 *   factor = 3.048E-1,
 *   type = "dimensions"
 * )
 */
class Feet extends Unit {
}
