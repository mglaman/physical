<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\CubicMillimeter.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Cubic Millimeter.
 *
 * @Unit(
 *   id = "cubic_millimeter",
 *   label = @Translation("Cubic millimeter"),
 *   unit = "mm³",
 *   factor = 1E-9,
 *   type = "volume"
 * )
 */
class CubicMillimeter extends Unit {
}
