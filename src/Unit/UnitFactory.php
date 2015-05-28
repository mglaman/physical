<?php

/**
 * @file
 * Contains \Drupal\physical\Unit\UnitFactory.
 */

namespace Drupal\physical\Unit;

/**
 * Class UnitFactory.
 *
 * @todo Move these into annotated plugins, which define measurement type.
 */
class UnitFactory {

  /**
   * Initiates a unit for Inches.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function inches() {
    return new Unit(self::t('Inches'), 'in', 2.54E-2);
  }

  /**
   * Initiates a unit for Feet.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function feet() {
    return new Unit(self::t('Feet'), 'ft', 3.048E-1);
  }

  /**
   * Initiates a unit for Millimeters.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function millimeters() {
    return new Unit(self::t('Millimeters'), 'mm', 1E-3);
  }

  /**
   * Initiates a unit for Centimeters.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function centimeters() {
    return new Unit(self::t('Centimeters'), 'cm', 1E-2);
  }

  /**
   * Initiates a unit for Meters.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function meters() {
    return new Unit(self::t('Meters'), 'm', 1);
  }

  /**
   * Initiates a unit for Grams.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function grams() {
    return new Unit(self::t('Grams'), 'g', 1e-3);
  }

  /**
   * Initiates a unit for Kilograms.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function kilograms() {
    return new Unit(self::t('Kilograms'), 'kg', 1);
  }

  /**
   * Initiates a unit for Ounces.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function ounces() {
    return new Unit(self::t('Ounces'), 'oz', 2.83495E-2);
  }

  /**
   * Initiates a unit for Pounds.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function pounds() {
    return new Unit(self::t('Pounds'), 'lb', 0.45359237);
  }

  /**
   * Initiates a unit for Cubic meters.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function cubicMeter() {
    return new Unit(self::t('Cubic meter'), 'm³', 1);
  }

  /**
   * Initiates a unit for Cubic millimeters.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function cubicMillimeter() {
    return new Unit(self::t('Cubic millimeter'), 'mm³', 1E-9);
  }

  /**
   * Initiates a unit for Cubic centimeters.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function cubicCentimeter() {
    return new Unit(self::t('Cubic Centimeter'), 'cm³', 1E-6);
  }

  /**
   * Initiates a unit for Cubic yard.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function cubicYard() {
    return new Unit(self::t('Cubic yard'), 'yd³', 7.64554858E-1);
  }

  /**
   * Initiates a unit for Cubic foot.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function cubicFoot() {
    return new Unit(self::t('Cubic foot'), 'f³', 2.8316846E-2);
  }

  /**
   * Initiates a unit for Cubic inch.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function cubicInch() {
    return new Unit(self::t('Cubic inch'), 'in³', 1.6387064E-5);
  }

  /**
   * Initiates a unit for Liter.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function liter() {
    return new Unit(self::t('Liter'), 'l', 1e-3);
  }

  /**
   * Initiates a unit for Cup.
   *
   * @return \Drupal\physical\Unit\Unit
   *   An initiated Unit object.
   */
  public static function cup() {
    return new Unit(self::t('Cup'), 'cup', 2.365882e-4);
  }

  /**
   * Translates a string to the current language or to a given language.
   *
   * See the t() documentation for details.
   */
  public static function t($string, array $args = array(), array $options = array()) {
    return \Drupal::service('string_translation')->translate($string, $args, $options);
  }

}
