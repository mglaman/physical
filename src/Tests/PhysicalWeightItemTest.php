<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\PhysicalWeightItemTest.
 */

namespace Drupal\physical\Tests;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\field\Tests\FieldUnitTestBase;

/**
 * Tests the new entity API for the physical weight field type.
 *
 * @group physical
 */
class PhysicalWeightItemTest extends FieldUnitTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('physical');

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // Create a physical weight field storage and field for validation.
    entity_create('field_storage_config', array(
      'field_name' => 'field_test',
      'entity_type' => 'entity_test',
      'type' => 'physical_weight',
    ))->save();
    entity_create('field_config', array(
      'entity_type' => 'entity_test',
      'field_name' => 'field_test',
      'bundle' => 'entity_test',
    ))->save();
  }

  /**
   * Tests using entity fields of the physical weight field type.
   */
  public function testTestItem() {
    $weight_value = 10;
    $weight_unit = 'lb';

    // Verify entity creation.
    $entity = entity_create('entity_test');
    $entity->field_test->weight = $weight_value;
    $entity->field_test->unit = $weight_unit;
    $entity->name->value = $this->randomMachineName();
    $entity->save();

    // Verify entity has been created properly.
    $id = $entity->id();
    $entity = entity_load('entity_test', $id);
    $this->assertTrue($entity->field_test instanceof FieldItemListInterface, 'Field implements interface.');
    $this->assertTrue($entity->field_test[0] instanceof FieldItemInterface, 'Field item implements interface.');
    $this->assertEqual($entity->field_test->weight, $weight_value);
    $this->assertEqual($entity->field_test[0]->weight, $weight_value);
    $this->assertEqual($entity->field_test->unit, $weight_unit);
    $this->assertEqual($entity->field_test[0]->unit, $weight_unit);

    // Verify changing the field value.
    $new_value = rand(0, 10);
    $entity->field_test->weight = $new_value;
    $this->assertEqual($entity->field_test->weight, $new_value);

    // Read changed entity and assert changed values.
    $entity->save();
    $entity = entity_load('entity_test', $id);
    $this->assertEqual($entity->field_test->weight, $new_value);
  }

}
