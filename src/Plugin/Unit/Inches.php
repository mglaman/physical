<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Unit\Inches.
 */

namespace Drupal\physical\Plugin\Unit;

use Drupal\physical\Unit;

/**
 * A unit for Inches.
 *
 * @Unit(
 *   id = "inches",
 *   label = @Translation("Inches"),
 *   unit = "in",
 *   factor = 2.54E-2,
 *   type = "dimensions"
 * )
 */
class Inches extends Unit {
}
