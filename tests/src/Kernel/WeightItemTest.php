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
class WeightItemTest extends EntityKernelTestBase {

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
      'field_name' => 'test_weight',
      'entity_type' => 'entity_test',
      'type' => 'physical_weight',
    ]);
    $field_storage->save();

    $field = FieldConfig::create([
      'field_name' => 'test_weight',
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
      'test_weight' => [
        'weight' => '10',
        'unit' => 'lbs',
      ],
    ]);
    $entity->save();
    $entity = $this->reloadEntity($entity);

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalItemInterface $physical_item */
    $physical_item = $entity->get('test_weight')->first();
    $unit = $physical_item->getUnit();
    $weight = $physical_item->get('weight')->getValue();
    $this->assertEquals(10, $unit->round($weight));
    $converted = $physical_item->convert('kg');
    $this->assertEquals(4.53592, $converted);
  }

}
