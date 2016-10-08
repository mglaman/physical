<?php

namespace Drupal\Tests\physical\Kernel;

use Drupal\entity_test\Entity\EntityTest;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;

/**
 * Tests the 'physical_volume' field type.
 *
 * @group physical
 */
class VolumetItemTest extends EntityKernelTestBase {

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
      'field_name' => 'test_volume',
      'entity_type' => 'entity_test',
      'type' => 'physical_volume',
    ]);
    $field_storage->save();

    $field = FieldConfig::create([
      'field_name' => 'test_volume',
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
      'test_volume' => [
        'volume' => '10',
        'unit' => 'ft³',
      ],
    ]);
    $entity->save();
    $entity = $this->reloadEntity($entity);

    /** @var \Drupal\physical\Plugin\Field\FieldType\PhysicalItemInterface $physical_item */
    $physical_item = $entity->get('test_volume')->first();
    $unit = $physical_item->getUnit();
    $volume = $physical_item->get('volume')->getValue();
    $this->assertEquals(10, $unit->round($volume));
    $converted = $physical_item->convert('in³');
    $this->assertEquals(17280.09362, $converted);
  }

}
