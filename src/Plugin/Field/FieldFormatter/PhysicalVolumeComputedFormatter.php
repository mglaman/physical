<?php

/**
 * @file
 * Contains .
 */

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\physical\Volume;

/**
 * Plugin implementation of the 'physical_volume_formatted' formatter.
 *
 * @FieldFormatter(
 *   id = "physical_volume_computed",
 *   label = @Translation("Computed volume"),
 *   field_types = {
 *     "physical_volume"
 *   }
 * )
 */
class PhysicalVolumeComputedFormatter extends PhysicalFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $element = [];

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalVolumeItem $item */
    foreach ($items as $delta => $item) {
      $volume = new Volume();
      $unit = $volume->getUnit($item->unit);

      $volume->setHeight($item->height, $unit->getUnit());
      $volume->setLength($item->length, $unit->getUnit());
      $volume->setWidth($item->width, $unit->getUnit());

      $element[$delta] = array(
        '#markup' => $volume->getVolume($unit->getUnit()) . ' ' . $unit->getUnit() . '<sup>3</sup>',
      );
    }
    return $element;
  }

}
