<?php

/**
 * @file
 * Contains \Drupal\physical\Unit\UnitInterface.
 */

namespace Drupal\physical\Unit;

/**
 * Interface UnitInterface.
 */
interface UnitInterface {
  /**
   * Creates a measurement unit.
   *
   * @param string $label
   *   The display title for the unit.
   * @param string $unit
   *   The unit's abbreviation representation.
   * @param int|float $factor
   *   The factor amount for converting between units.
   */
  public function __construct($label, $unit, $factor);

  /**
   * Sets the unit's label.
   *
   * @param string $string
   *    The label to use.
   */
  public function setLabel($string);

  /**
   * Returns the unit's label.
   *
   * @return string
   *   The unit's label.
   */
  public function getLabel();

  /**
   * Sets the unit abbreviation.
   *
   * @param string $string
   *   The abbreviation.
   */
  public function setUnit($string);

  /**
   * Returns the unit abbreviation..
   *
   * @return string
   *    The abbreviation.
   */
  public function getUnit();

  /**
   * Sets the conversion factor amount.
   *
   * @param int|float $numeric
   *   The factor amount.
   */
  public function setFactor($numeric);

  /**
   * Returns the factor amount for conversions.
   *
   * @return int|float
   *   The factor amount.
   */
  public function getFactor();

  /**
   * Converts a value to the base unit.
   *
   * @param int|float $value
   *    The amount to convert.
   *
   * @return int|float
   *   The converted amount.
   */
  public function toBase($value);

  /**
   * Converts value from base unit to current unit.
   *
   * @param int|float $value
   *    The amount to convert.
   *
   * @return int|float
   *   The converted amount.
   */
  public function fromBase($value);

  /**
   * Rounds a value.
   *
   * @param int|float $value
   *    The value to round.
   *
   * @return int|float
   *   The rounded value.
   */
  public function round($value);

}
