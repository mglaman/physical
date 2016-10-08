<?php

namespace Drupal\physical\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
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
class PhysicalVolumeFormattedFormatter extends PhysicalFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->physicalObject = new Volume();
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $element = [];

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalVolumeItem $item */
    foreach ($items as $delta => $item) {
      $unit = $this->physicalObject->getUnit($item->unit);

      $element[$delta] = array(
        '#markup' => $this->t('@value @unit', array(
          '@value' => $unit->round($item->weight),
          '@unit' => $unit->getUnit(),
        )
        ),
      );
    }
    return $element;
  }

}
