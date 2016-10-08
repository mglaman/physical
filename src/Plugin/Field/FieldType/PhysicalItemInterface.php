<?php

namespace Drupal\physical\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Interface for physical field items.
 */
interface PhysicalItemInterface extends FieldItemInterface {

  /**
   * Gets the physical measurement unit.
   *
   * @return \Drupal\physical\Plugin\Physical\UnitInterface
   *   The unit.
   */
  public function getUnit();

}
