<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\Pounds.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Pounds.
 *
 * @Unit(
 *   id = "pounds",
 *   label = @Translation("Pounds"),
 *   unit = "lb",
 *   factor = 0.45359237,
 *   type = "weight"
 * )
 */
class Pounds extends Unit {
}
