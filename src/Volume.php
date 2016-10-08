<?php


namespace Drupal\physical;

use Drupal\physical\UnitManager;

/**
 * Class Weight.
 */
class Volume extends Physical {

  /**
   * {@inheritdoc}
   *
   * Defaults to meters cubed.
   */
  protected $defaultUnit = 'm³';

  /**
   * Constructs a new Physical object.
   *
   * @param \Drupal\physical\UnitManager $unit_manager
   *   The unit manager.
   */
  public function __construct(UnitManager $unit_manager) {
    parent::__construct($unit_manager);
    $this->addComponent('volume');

    foreach ($this->unitManager->getByType('volume') as $unit) {
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
