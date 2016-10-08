<?php

namespace Drupal\physical;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Interface for the physical unit plugin manager.
 */
interface UnitManagerInterface extends PluginManagerInterface {

  /**
   * Gets unit plugins for a measurement type.
   *
   * @param string $type
   *    Measurement type.
   *
   * @return \Drupal\physical\Plugin\Physical\UnitInterface[]
   *    Returns array of unit plugins.
   */
  public function getUnitsForType($type);

  /**
   * Gets a unit.
   *
   * @param string $unit
   *   The unit.
   *
   * @return \Drupal\physical\Plugin\Physical\UnitInterface
   *   The physical unit.
   */
  public function getUnit($unit);

  /**
   * Converts a value to a different unit.
   *
   * @param int|float $value
   *   The value.
   * @param string $from
   *   The from unit.
   * @param string $to
   *   The to unit.
   *
   * @return int|float
   *   The converted value.
   */
  public function convertValue($value, $from, $to);

}
