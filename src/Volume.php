<?php

/**
 * @file
 * Contains \Drupal\physical\Volume.
 */

namespace Drupal\physical;

use Drupal\physical\Unit\UnitFactory;

/**
 * Class Weight.
 */
class Volume extends Physical {
  /**
   * Define components and units.
   */
  public function __construct() {
    $this->addComponent('volume');
    $this->addUnit(UnitFactory::cubicMeter());
    $this->addUnit(UnitFactory::cubicMeter());
    $this->addUnit(UnitFactory::cubicMillimeter());
    $this->addUnit(UnitFactory::cubicCentimeter());
    $this->addUnit(UnitFactory::cubicYard());
    $this->addUnit(UnitFactory::cubicFoot());
    $this->addUnit(UnitFactory::cubicInch());
    $this->addUnit(UnitFactory::liter());
    $this->addUnit(UnitFactory::cup());

    $this->setDefault(UnitFactory::cubicMeter()->getUnit());
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
