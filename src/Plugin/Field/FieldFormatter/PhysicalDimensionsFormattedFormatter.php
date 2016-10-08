<?php

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\physical\Dimensions;

/**
 * Plugin implementation of the 'physical_dimensions_formatted' formatter.
 *
 * @FieldFormatter(
 *   id = "physical_dimensions_formatted",
 *   label = @Translation("Formatted dimensions"),
 *   field_types = {
 *     "physical_dimensions"
 *   }
 * )
 */
class PhysicalDimensionsFormattedFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalDimensionsItem $item */
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#markup' => implode(' &times; ', [
          $item->length,
          $item->width,
          $item->height,
        ]) . ' ' . $item->unit,
      ];
    }
    return $element;
  }

}
