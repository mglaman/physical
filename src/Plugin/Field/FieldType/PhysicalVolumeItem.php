<?php

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
class PhysicalVolumeItem extends FieldItemBase implements PhysicalItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'volume' => [
          'description' => 'The numeric volume value.',
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
    $properties['volume'] = DataDefinition::create('float')
      ->setLabel(t('Volume'))
      ->setRequired(TRUE);
    $properties['unit'] = DataDefinition::create('string')
      ->setLabel(t('Physical unit'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function mainPropertyName() {
    return 'volume';
  }

  /**
   * {@inheritdoc}
   */
  public function getUnit() {
    $manager = \Drupal::getContainer()->get('plugin.manager.unit');
    return $manager->getUnit($this->get('unit')->getValue());
  }

  /**
   * {@inheritdoc}
   */
  public function convert($to) {
    $manager = \Drupal::getContainer()->get('plugin.manager.unit');
    return $manager->convertValue($this->get('volume')->getValue(), $this->get('unit')->getValue(), $to);
  }

}
