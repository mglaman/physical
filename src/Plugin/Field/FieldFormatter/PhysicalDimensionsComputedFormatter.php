<?php

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\physical\Dimensions;

/**
 * Plugin implementation of the 'physical_dimensions_formatted' formatter.
 *
 * @FieldFormatter(
 *   id = "physical_dimensions_computed",
 *   label = @Translation("Computed dimensions"),
 *   field_types = {
 *     "physical_dimensions"
 *   }
 * )
 */
class PhysicalDimensionsComputedFormatter extends PhysicalFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $element = [];

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalDimensionsItem $item */
    foreach ($items as $delta => $item) {
      $volume = new Dimensions();
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
