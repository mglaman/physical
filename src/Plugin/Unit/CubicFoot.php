<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\CubicFoot.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Cubic Foot.
 *
 * @Unit(
 *   id = "cubic_foot",
 *   label = @Translation("Cubic foot"),
 *   unit = "ft³",
 *   factor = 2.8316846E-2,
 *   type = "volume"
 * )
 */
class CubicFoot extends Unit {
}
