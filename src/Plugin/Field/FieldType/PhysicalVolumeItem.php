<?php

/**
 * @file
 * Contains \Drupal\physical\Plugin\Field\FieldType\PhysicalWeightItem.
 */

namespace Drupal\physical\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'physical_volume' field type.
 *
 * @FieldType(
 *   id = "physical_volume",
 *   label = @Translation("Physical volume"),
 *   description = @Translation("This field stores the a physical volume amount and unit of measure."),
 *   category = @Translation("Physical"),
 *   default_widget = "physical_volume_default",
 *   default_formatter = "physical_volume_formatted"
 * )
 */
class PhysicalVolumeItem extends FieldItemBase {
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'volume' => array(
          'description' => 'The numeric volume value.',
          'type' => 'numeric',
          'size' => 'normal',
          'default' => 0,
          'precision' => 15,
          'scale' => 5,
        ),
        'unit' => array(
          'description' => 'The unit of measurement.',
          'type' => 'varchar',
          'length' => '255',
          'not null' => TRUE,
          'default' => '',
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['volume'] = DataDefinition::create('integer')
                                         ->setLabel(t('Volume'))
                                         ->setRequired(TRUE);
    $properties['unit'] = DataDefinition::create('string')
                                        ->setLabel(t('Physical unit'));

    return $properties;
  }

}
