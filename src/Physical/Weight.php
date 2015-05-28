<?php

/**
 * @file
 * Contains \Drupal\physical\Weight.
 */

namespace Drupal\physical\Physical;

/**
 * Class Weight.
 */
class Weight extends Physical {

  /**
   * {@inheritdoc}
   *
   * Defaults to kilograms.
   */
  protected $defaultUnit = 'kg';

  /**
   * Define components and units.
   */
  public function __construct() {
    $this->addComponent('weight');

    foreach ($this->getUnitPlugins('weight') as $unit) {
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
  public function setWeight($value, $unit_type) {
    $this->setComponentValue('weight', $value, $unit_type);
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
  public function getWeight($unit_type) {
    return $this->getComponentValue('weight', $unit_type);
  }

}
