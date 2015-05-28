<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\Millimeters.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Millimeters.
 *
 * @Unit(
 *   id = "millimeters",
 *   label = @Translation("Millimeters"),
 *   unit = "mm",
 *   factor = 1E-3,
 *   type = "dimensions"
 * )
 */
class Millimeters extends Unit {
}
