<?php

namespace Drupal\physical\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Interface for physical items.
 */
interface PhysicalItemInterface extends FieldItemInterface {

  /**
   * Gets the class physical quantity class used by the field item.
   *
   * @return \PhpUnitsOfMeasure\AbstractPhysicalQuantity
   *   The physical quantity class.
   */
  public function getPhysicalQuantityClass();

  /**
   * Get the physical quantity unit.
   *
   * @return \PhpUnitsOfMeasure\PhysicalQuantityInterface
   *   The physical quantity unit.
   */
  public function getUnit();

  /**
   * The physical quantity in a readable format.
   *
   * @return string
   *   The physical quantity as a string.
   */
  public function toString();

}
