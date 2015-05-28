<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\CubicInch.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Cubic Inch.
 *
 * @Unit(
 *   id = "cubic_inch",
 *   label = @Translation("Cubic inch"),
 *   unit = "in³",
 *   factor = 1.6387064E-5,
 *   type = "volume"
 * )
 */
class CubicInch extends Unit {
}
