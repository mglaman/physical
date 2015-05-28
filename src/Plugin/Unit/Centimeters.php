<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\Centimeters.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Centimeters.
 *
 * @Unit(
 *   id = "centimeters",
 *   label = @Translation("Centimeters"),
 *   unit = "cm",
 *   factor = 1E-2,
 *   type = "dimensions"
 * )
 */
class Centimeters extends Unit {
}
