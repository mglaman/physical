<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\Grams.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Grams.
 *
 * @Unit(
 *   id = "grams",
 *   label = @Translation("Grams"),
 *   unit = "g",
 *   factor = 1e-3,
 *   type = "weight"
 * )
 */
class Grams extends Unit {
}
