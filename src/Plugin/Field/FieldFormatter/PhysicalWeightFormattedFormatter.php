<?php

/**
 * @file
 * Contains .
 */

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
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
class PhysicalWeightFormattedFormatter extends PhysicalFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->physicalObject = new Weight();
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $element = [];

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalWeightItem $item */
    foreach ($items as $delta => $item) {
      $unit = $this->physicalObject->getUnit($item->unit);

      $element[$delta] = array(
        '#markup' => $this->t('@weight @unit', array(
          '@weight' => $unit->round($item->weight),
          '@unit' => $unit->getUnit(),
          )
        ),
      );
    }
    return $element;
  }

}
