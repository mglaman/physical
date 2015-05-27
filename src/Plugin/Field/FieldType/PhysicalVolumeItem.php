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
        'length' => array(
          'description' => 'The numeric length value.',
          'type' => 'numeric',
          'size' => 'normal',
          'default' => 0,
          'precision' => 15,
          'scale' => 5,
        ),
        'width' => array(
          'description' => 'The numeric width value.',
          'type' => 'numeric',
          'size' => 'normal',
          'default' => 0,
          'precision' => 15,
          'scale' => 5,
        ),
        'height' => array(
          'description' => 'The numeric height value.',
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
    $properties['length'] = DataDefinition::create('integer')
                                         ->setLabel(t('Length'))
                                         ->setRequired(TRUE);
    $properties['width'] = DataDefinition::create('integer')
                                          ->setLabel(t('Width'))
                                          ->setRequired(TRUE);
    $properties['height'] = DataDefinition::create('integer')
                                          ->setLabel(t('Height'))
                                          ->setRequired(TRUE);
    $properties['unit'] = DataDefinition::create('string')
                                        ->setLabel(t('Physical unit'));

    return $properties;
  }

}
