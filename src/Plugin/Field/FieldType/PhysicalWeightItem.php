<?php

namespace Drupal\physical\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'physical_weight' field type.
 *
 * @FieldType(
 *   id = "physical_weight",
 *   label = @Translation("Physical weight"),
 *   description = @Translation("This field stores the a physical weight amount and unit of measure."),
 *   category = @Translation("Physical"),
 *   default_widget = "physical_weight_default",
 *   default_formatter = "physical_weight_formatted"
 * )
 */
class PhysicalWeightItem extends FieldItemBase implements PhysicalItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'weight' => [
          'description' => 'The numeric weight value.',
          'type' => 'numeric',
          'size' => 'normal',
          'not null' => TRUE,
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
      'indexes' => [
        'weight' => ['weight'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['weight'] = DataDefinition::create('float')
      ->setLabel(t('Physical weight'))
      ->setRequired(TRUE);
    $properties['unit'] = DataDefinition::create('string')
      ->setLabel(t('Physical unit'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function mainPropertyName() {
    return 'weight';
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('weight')->getValue();
    return $value === NULL || $value === '';
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
    return $manager->convertValue($this->get('weight')->getValue(), $this->get('unit')->getValue(), $to);
  }

}
