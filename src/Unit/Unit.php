<?php

/**
 * @file
 * Contains \Drupal\physical\Unit\Unit.
 */

namespace Drupal\physical\Unit;

/**
 * Class Unit.
 */
class Unit implements UnitInterface {
  /**
   * The factor amount for conversions.
   *
   * @var int
   */
  protected $factor = 0;

  /**
   * The unit's label.
   *
   * @var
   */
  protected $label;

  /**
   * The unit's abbreviation.
   *
   * @var
   */
  protected $unit;

  /**
   * {@inheritdoc}
   */
  public function __construct($label, $unit, $factor) {
    $this->setLabel($label);
    $this->setUnit($unit);
    $this->setFactor($factor);
  }

  /**
   * {@inheritdoc}
   */
  public function setFactor($numeric) {
    $this->factor = $numeric;
  }

  /**
   * {@inheritdoc}
   */
  public function getFactor() {
    return $this->factor;
  }

  /**
   * {@inheritdoc}
   */
  public function setLabel($string) {
    $this->label = $string;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * {@inheritdoc}
   */
  public function setUnit($string) {
    $this->unit = $string;
  }

  /**
   * {@inheritdoc}
   */
  public function getUnit() {
    return $this->unit;
  }

  /**
   * {@inheritdoc}
   */
  public function toBase($value) {
    return $this->round($value * $this->getFactor());
  }

  /**
   * {@inheritdoc}
   */
  public function fromBase($value) {
    return $this->round($value / $this->getFactor());
  }

  /**
   * {@inheritdoc}
   */
  public function round($value) {
    return round($value, 5);
  }

  /**
   * Returns the unit's label.
   *
   * @return string
   *   Unit label.
   */
  public function __toString() {
    return $this->getLabel();
  }

}
