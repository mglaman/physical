<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\Liter.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Liter.
 *
 * @Unit(
 *   id = "liter",
 *   label = @Translation("Liter"),
 *   unit = "l",
 *   factor = 1e-3,
 *   type = "volume"
 * )
 */
class Liter extends Unit {
}
