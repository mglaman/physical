<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\PhysicalvolumeItemTest.
 */

namespace Drupal\physical\Tests;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\field\Tests\FieldUnitTestBase;

/**
 * Tests the new entity API for the physical volume field type.
 *
 * @group physical
 */
class PhysicalVolumeItemTest extends FieldUnitTestBase {

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

    // Create a physical volume field storage and field for validation.
    entity_create('field_storage_config', array(
      'field_name' => 'field_test',
      'entity_type' => 'entity_test',
      'type' => 'physical_volume',
    ))->save();
    entity_create('field_config', array(
      'entity_type' => 'entity_test',
      'field_name' => 'field_test',
      'bundle' => 'entity_test',
    ))->save();
  }

  /**
   * Tests using entity fields of the physical volume field type.
   */
  public function testTestItem() {
    $volume_value = 10;
    $volume_unit = 'lb';

    // Verify entity creation.
    $entity = entity_create('entity_test');
    $entity->field_test->volume = $volume_value;
    $entity->field_test->unit = $volume_unit;
    $entity->name->value = $this->randomMachineName();
    $entity->save();

    // Verify entity has been created properly.
    $id = $entity->id();
    $entity = entity_load('entity_test', $id);
    $this->assertTrue($entity->field_test instanceof FieldItemListInterface, 'Field implements interface.');
    $this->assertTrue($entity->field_test[0] instanceof FieldItemInterface, 'Field item implements interface.');
    $this->assertEqual($entity->field_test->volume, $volume_value);
    $this->assertEqual($entity->field_test[0]->volume, $volume_value);
    $this->assertEqual($entity->field_test->unit, $volume_unit);
    $this->assertEqual($entity->field_test[0]->unit, $volume_unit);

    // Verify changing the field value.
    $new_value = rand(0, 10);
    $entity->field_test->volume = $new_value;
    $this->assertEqual($entity->field_test->volume, $new_value);

    // Read changed entity and assert changed values.
    $entity->save();
    $entity = entity_load('entity_test', $id);
    $this->assertEqual($entity->field_test->volume, $new_value);
  }

}
