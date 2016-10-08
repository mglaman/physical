<?php

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class PhysicalFormatterBase.
 *
 * @todo: General formatter to allow unit to be changed.
 */
abstract class PhysicalFormatterBase extends FormatterBase {
  use StringTranslationTrait;

  /**
   * Physical object.
   *
   * @var \Drupal\physical\PhysicalInterface
   */
  protected $physicalObject;

}
