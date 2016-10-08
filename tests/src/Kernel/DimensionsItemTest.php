<?php

namespace Drupal\Tests\physical\Kernel;

use Drupal\entity_test\Entity\EntityTest;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;

/**
 * Tests the 'physical_weight' field type.
 *
 * @group physical
 */
class DimensionsItemTest extends EntityKernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'physical',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $field_storage = FieldStorageConfig::create([
      'field_name' => 'test_dimensions',
      'entity_type' => 'entity_test',
      'type' => 'physical_dimensions',
    ]);
    $field_storage->save();

    $field = FieldConfig::create([
      'field_name' => 'test_dimensions',
      'entity_type' => 'entity_test',
      'bundle' => 'entity_test',
    ]);
    $field->save();
  }

  /**
   * Tests the field.
   */
  public function testField() {
    /** @var \Drupal\entity_test\Entity\EntityTest $entity */
    $entity = EntityTest::create([
      'test_dimensions' => [
        'length' => '5',
        'width' => '7',
        'height' => '2',
        'unit' => 'in',
      ],
    ]);
    $entity->save();
    $entity = $this->reloadEntity($entity);

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalItemInterface $physical_item */
    $physical_item = $entity->get('test_dimensions')->first();
    $this->assertEquals(5, $physical_item->get('length')->getValue());
    $this->assertEquals(7, $physical_item->get('width')->getValue());
    $this->assertEquals(2, $physical_item->get('height')->getValue());
  }

}
