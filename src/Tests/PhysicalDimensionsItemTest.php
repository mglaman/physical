<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\PhysicalDimensionsItemTest.
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
class PhysicalDimensionsItemTest extends FieldUnitTestBase {

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
      'type' => 'physical_dimensions',
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
    $dimensions = [
      'length' => 3,
      'width' => 2,
      'height' => 3,
    ];
    $weight_unit = 'lb';

    // Verify entity creation.
    $entity = entity_create('entity_test');
    $entity->field_test->length = $dimensions['length'];
    $entity->field_test->width = $dimensions['width'];
    $entity->field_test->height = $dimensions['height'];
    $entity->field_test->unit = $weight_unit;
    $entity->name->value = $this->randomMachineName();
    $entity->save();

    // Verify entity has been created properly.
    $id = $entity->id();
    $entity = entity_load('entity_test', $id);
    $this->assertTrue($entity->field_test instanceof FieldItemListInterface, 'Field implements interface.');
    $this->assertTrue($entity->field_test[0] instanceof FieldItemInterface, 'Field item implements interface.');
    $this->assertEqual($entity->field_test->length, $dimensions['length']);
    $this->assertEqual($entity->field_test[0]->length, $dimensions['length']);
    $this->assertEqual($entity->field_test->width, $dimensions['width']);
    $this->assertEqual($entity->field_test[0]->width, $dimensions['width']);
    $this->assertEqual($entity->field_test->height, $dimensions['height']);
    $this->assertEqual($entity->field_test[0]->height, $dimensions['height']);

    // Verify changing the field value.
    $new_dimensions = [
      'length' => rand(0, 10),
      'width' => rand(0, 10),
      'height' => rand(0, 10),
    ];
    $entity->field_test->length = $new_dimensions['length'];
    $entity->field_test->width = $new_dimensions['width'];
    $entity->field_test->height = $new_dimensions['height'];
    $this->assertEqual($entity->field_test->length, $new_dimensions['length']);
    $this->assertEqual($entity->field_test->width, $new_dimensions['width']);
    $this->assertEqual($entity->field_test->height, $new_dimensions['height']);

    // Read changed entity and assert changed values.
    $entity->save();
    $entity = entity_load('entity_test', $id);
    $this->assertEqual($entity->field_test->length, $new_dimensions['length']);
    $this->assertEqual($entity->field_test->width, $new_dimensions['width']);
    $this->assertEqual($entity->field_test->height, $new_dimensions['height']);
  }

}
