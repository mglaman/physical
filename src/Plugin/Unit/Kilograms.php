<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\Kilograms.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Kilograms.
 *
 * @Unit(
 *   id = "kilograms",
 *   label = @Translation("Kilograms"),
 *   unit = "kg",
 *   factor = 1,
 *   type = "weight"
 * )
 */
class Kilograms extends Unit {
}
