<?php

namespace Drupal\physical;

use Drupal\physical\Plugin\Physical\UnitInterface;

/**
 * Interface PhysicalInterface.
 */
interface PhysicalInterface {

  /**
   * Adds a component that makes up physical measurement.
   *
   * @param string $string
   *   The component's name.
   */
  public function addComponent($string);

  /**
   * Returns array of components.
   *
   * @return array
   *   Returns array of components added to this physical measurement.
   */
  public function getComponents();

  /**
   * Adds a unit of measurement.
   *
   * @param \Drupal\physical\Plugin\Physical\UnitInterface $unit
   *   Adds a unit that values can be processed as.
   */
  public function addUnit(UnitInterface $unit);

  /**
   * Returns array of defined units.
   *
   * @return \Drupal\physical\Plugin\Physical\UnitInterface[]
   *   Returns array of units added to this physical measurement.
   */
  public function getUnits();

  /**
   * Returns a specific unit.
   *
   * @param string $unit_type
   *   The type of unit.
   *
   * @return \Drupal\physical\Plugin\Physical\UnitInterface
   *   A unit object.
   */
  public function getUnit($unit_type);

  /**
   * Sets a unit as the base unit.
   *
   * @param string $abbreviation
   *   Define unit from the added units as the default measurement unit.
   */
  public function setDefault($abbreviation);

}
