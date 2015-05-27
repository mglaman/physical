<?php

/**
 * @file
 * Contains \Drupal\physical\Weight.
 */

namespace Drupal\physical;

use Drupal\physical\Unit\UnitFactory;

/**
 * Class Weight.
 */
class Weight extends Physical {
  /**
   * Define components and units.
   */
  public function __construct() {
    $this->addComponent('weight');
    $this->addUnit(UnitFactory::grams());
    $this->addUnit(UnitFactory::kilograms());
    $this->addUnit(UnitFactory::ounces());
    $this->addUnit(UnitFactory::pounds());

    $this->setDefault(UnitFactory::kilograms()->getUnit());
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
