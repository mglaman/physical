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
class PhysicalWeightItem extends FieldItemBase {
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'weight' => array(
          'description' => 'The numeric weight value.',
          'type' => 'numeric',
          'size' => 'normal',
          'not null' => TRUE,
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
      'indexes' => array(
        'weight' => array('weight'),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['weight'] = DataDefinition::create('integer')
                                         ->setLabel(t('Physical weight'))
                                         ->setRequired(TRUE);
    $properties['unit'] = DataDefinition::create('string')
                                          ->setLabel(t('Physical unit'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('weight')->getValue();
    return $value === NULL || $value === '';
  }

}
