<?php

namespace Drupal\physical;

use Drupal\physical\UnitManagerInterface;
use Drupal\physical\Plugin\Physical\UnitInterface;

/**
 * Class Physical.
 *
 * Abstract class to act as a basis for physical measurement types.
 */
abstract class Physical implements PhysicalInterface {

  /**
   * Array of components.
   *
   * @var array
   */
  protected $components = [];

  /**
   * Array of units.
   *
   * @var \Drupal\physical\Plugin\Physical\UnitInterface[]
   */
  protected $units = [];

  /**
   * The default unit for factors.
   *
   * @var string
   *
   * This is set based on the International System of Units default.
   * @link http://en.wikipedia.org/wiki/Measurement#International_System_of_Units.
   */
  protected $defaultUnit;

  /**
   * The unit manager.
   *
   * @var \Drupal\physical\UnitManagerInterface
   */
  protected $unitManager;

  /**
   * Constructs a new Physical object.
   *
   * @param \Drupal\physical\UnitManagerInterface $unit_manager
   *   The unit manager.
   */
  public function __construct(UnitManagerInterface $unit_manager) {
    $this->unitManager = $unit_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function addComponent($string) {
    $this->components[$string] = NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getComponents() {
    return $this->components;
  }

  /**
   * {@inheritdoc}
   */
  public function addUnit(UnitInterface $unit) {
    $this->units[$unit->getUnit()] = $unit;
  }

  /**
   * {@inheritdoc}
   */
  public function getUnits() {
    return $this->units;
  }

  /**
   * {@inheritdoc}
   */
  public function getUnit($unit_type) {
    if (isset($this->getUnits()[$unit_type])) {
      return $this->getUnits()[$unit_type];
    }
    else {
      var_dump($this->getUnits());
      throw new \Exception(sprintf('Unit plugin %s not found.', $unit_type));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function setDefault($abbreviation) {
    $this->defaultUnit = $abbreviation;
  }

  /**
   * Sets a components value.
   *
   * The value will be converted from it's current unit type to the default
   * unit type specified for normalization.
   *
   * @param string $component
   *   The component to target.
   * @param int|float $value
   *   The value to set.
   * @param string $unit_type
   *   The unit type to utilize.
   */
  protected function setComponentValue($component, $value, $unit_type) {
    $this->components[$component] = $this->getUnit($unit_type)->toBase($value);
  }

  /**
   * Returns a component's value.
   *
   * Takes a value from the components and returns it in its converted form for
   * the requested unit type.
   *
   * @param string $component
   *   The component to target.
   * @param string $unit_type
   *   The unit type to utilize.
   *
   * @return float
   *   The value, converted to the unit type specified.
   */
  protected function getComponentValue($component, $unit_type) {
    return $this->getUnit($unit_type)->fromBase($this->components[$component]);
  }

}
