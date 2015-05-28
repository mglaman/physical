<?php

/**
 * @file
 * Contains .
 */

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
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
class PhysicalDimensionsFormattedFormatter extends PhysicalFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->physicalObject = new Dimensions();
  }
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $element = [];

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalDimensionsItem $item */
    foreach ($items as $delta => $item) {
      $unit = $this->physicalObject->getUnit($item->unit);

      $data = array();

      foreach (array_keys($this->physicalObject->getComponents()) as $key) {
        $data[] = $unit->round($item->{$key});
      }

      $element[$delta] = array(
        '#markup' => implode(' &times; ', $data) . ' ' . $unit->getUnit(),
      );
    }
    return $element;
  }

}
