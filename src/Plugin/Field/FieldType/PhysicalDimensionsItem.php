<?php

namespace Drupal\physical\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'physical_volume' field type.
 *
 * @FieldType(
 *   id = "physical_dimensions",
 *   label = @Translation("Physical dimensions"),
 *   description = @Translation("This field stores the a physical dimensions and unit of measure."),
 *   category = @Translation("Physical"),
 *   default_widget = "physical_dimensions_default",
 *   default_formatter = "physical_dimensions_formatted"
 * )
 */
class PhysicalDimensionsItem extends FieldItemBase implements PhysicalItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'length' => [
          'description' => 'The numeric length value.',
          'type' => 'numeric',
          'size' => 'normal',
          'default' => 0,
          'precision' => 15,
          'scale' => 5,
        ],
        'width' => [
          'description' => 'The numeric width value.',
          'type' => 'numeric',
          'size' => 'normal',
          'default' => 0,
          'precision' => 15,
          'scale' => 5,
        ],
        'height' => [
          'description' => 'The numeric height value.',
          'type' => 'numeric',
          'size' => 'normal',
          'default' => 0,
          'precision' => 15,
          'scale' => 5,
        ],
        'unit' => [
          'description' => 'The unit of measurement.',
          'type' => 'varchar',
          'length' => '255',
          'not null' => TRUE,
          'default' => '',
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['length'] = DataDefinition::create('float')
      ->setLabel(t('Length'))
      ->setRequired(TRUE);
    $properties['width'] = DataDefinition::create('float')
      ->setLabel(t('Width'))
      ->setRequired(TRUE);
    $properties['height'] = DataDefinition::create('float')
      ->setLabel(t('Height'))
      ->setRequired(TRUE);
    $properties['unit'] = DataDefinition::create('string')
      ->setLabel(t('Physical unit'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function mainPropertyName() {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getUnit() {
    $manager = \Drupal::getContainer()->get('physical.weight');
    return $manager->getUnit($this->get('unit')->getValue());
  }

}
