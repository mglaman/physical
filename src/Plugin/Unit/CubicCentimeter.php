<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\CubicCentimeter.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Cubic Centimeter.
 *
 * @Unit(
 *   id = "cubic_centimeter",
 *   label = @Translation("Cubic centimeter"),
 *   unit = "cm³",
 *   factor = 1E-6,
 *   type = "volume"
 * )
 */
class CubicCentimeter extends Unit {
}
