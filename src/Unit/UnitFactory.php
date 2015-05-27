<?php

/**
 * @file
 * Contains \Drupal\physical\Unit\UnitFactory.
 */

namespace Drupal\physical\Unit;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class UnitFactory.
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
   * Translates a string to the current language or to a given language.
   *
   * See the t() documentation for details.
   */
  public static function t($string, array $args = array(), array $options = array()) {
    return \Drupal::service('string_translation')->translate($string, $args, $options);
  }

}
