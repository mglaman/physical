<?php

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\physical\Volume;

/**
 * Plugin implementation of the 'physical_volume_formatted' formatter.
 *
 * @FieldFormatter(
 *   id = "physical_volume_formatted",
 *   label = @Translation("Formatted volume"),
 *   field_types = {
 *     "physical_volume"
 *   }
 * )
 */
class PhysicalVolumeFormattedFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalVolumeItem $item */
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#markup' => $this->t('@volume @unit', [
          '@volume' => $item->volume,
          '@unit' => $item->unit,
        ]),
      ];
    }
    return $element;
  }

}
