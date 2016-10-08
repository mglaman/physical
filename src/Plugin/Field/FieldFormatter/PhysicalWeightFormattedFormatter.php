<?php

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\physical\Weight;

/**
 * Plugin implementation of the 'physical_weight_formatted' formatter.
 *
 * @FieldFormatter(
 *   id = "physical_weight_formatted",
 *   label = @Translation("Formatted weight"),
 *   field_types = {
 *     "physical_weight"
 *   }
 * )
 */
class PhysicalWeightFormattedFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalWeightItem $item */
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#markup' => $this->t('@weight @unit', [
          '@weight' => $item->weight,
          '@unit' => $item->unit,
        ]),
      ];
    }
    return $element;
  }

}
