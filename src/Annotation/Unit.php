<?php

/**
 * @file
 * Contains .
 */

namespace Drupal\physical\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Unit annotation object.
 *
 * @ingroup physical
 *
 * @Annotation
 */
class Unit extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The unit's label.
   *
   * @var string
   */
  public $label = '';

  /**
   * The unit's abbreviated representation.
   *
   * @var string
   */
  public $unit = '';

  /**
   * The unit's conversion factor amount.
   *
   * @var float
   */
  public $factor = 0.00;

  /**
   * The unit's measurement type.
   *
   * A unit can be for weight, dimensions, volume, etc.
   *
   * @var string
   */
  public $type = '';

}
