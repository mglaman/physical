<?php

namespace Drupal\physical\Plugin\Field\FieldType;
use Drupal\Core\Field\FieldItemBase;

/**
 * Base class for implementing physical item fields.
 */
abstract class PhysicalItemBase extends FieldItemBase implements PhysicalItemInterface {

  /**
   * {@inheritdoc}
   */
  public function getUnit() {
    if (!$this->isEmpty()) {
      $class = $this->getPhysicalQuantityClass();
      return new $class($this->get('value')->getValue(), $this->get('unit')->getValue());
    }
  }

  /**
   * {@inheritdoc}
   */
  public function toString() {
    if (!$this->isEmpty()) {
      $number = number_format($this->get('value')->getValue());
      return "{$number}{$this->get('unit')->getValue()}";
    }
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return $this->toString();
  }

}
