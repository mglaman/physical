<?php

/**
 * @file
 * Contains \Drupal\physical\Volume.
 */

namespace Drupal\physical\Physical;

/**
 * Class Weight.
 */
class Volume extends Physical {

  /**
   * {@inheritdoc}
   *
   * Defaults to kilograms.
   */
  protected $defaultUnit = 'm³';

  /**
   * Define components and units.
   */
  public function __construct() {
    $this->addComponent('volume');

    foreach (self::getUnitPlugins('volume') as $unit) {
      $this->addUnit($unit);
    }
  }

  /**
   * Sets weight.
   *
   * @param int|float $value
   *    The value to set the length to.
   * @param string $unit_type
   *    The unit type of the value.
   */
  public function setVolume($value, $unit_type) {
    $this->setComponentValue('volume', $value, $unit_type);
  }

  /**
   * Returns weight as specified unit.
   *
   * @param string $unit_type
   *   The value to set the length to.
   *
   * @return float
   *    Returns the unit's value.
   */
  public function getVolume($unit_type) {
    return $this->getComponentValue('volume', $unit_type);
  }

}
