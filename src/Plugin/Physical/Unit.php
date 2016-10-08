<?php

/**
 * @file
 * Contains \Drupal\physical\Unit\Unit.
 */

namespace Drupal\physical\Plugin\Physical;

use Drupal\Core\Plugin\PluginBase;

/**
 * Class Unit.
 */
class Unit extends PluginBase implements UnitInterface {

  /**
   * {@inheritdoc}
   */
  public function getFactor() {
    return (float) $this->pluginDefinition['factor'];
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->pluginDefinition['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function getUnit() {
    return $this->pluginDefinition['unit'];
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
