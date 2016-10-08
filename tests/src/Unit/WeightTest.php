<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\Unit\WeightTest.
 */

namespace Drupal\physical\Tests\Unit;

use Drupal\physical\Weight;
use Drupal\Tests\UnitTestCase;
use Drupal\physical\Plugin\Physical\Unit;

/**
 * Tests Weight units.
 *
 * @coversDefaultClass \Drupal\physical\Weight
 * @group physical
 */
class WeightTest extends UnitTestCase {

  /**
   * The mock unit plugin manager.
   *
   * @var \Drupal\physical\UnitManager|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $unitPluginManager;

  /**
   * Weight physical object.
   *
   * @var Weight
   */
  protected $weight;

  /**
   * {@inheritdoc}
   *
   * @covers ::__construct
   */
  protected function setUp() {
    parent::setUp();

    $definitions = [
      'pounds' => [
        'id' => 'pounds',
        'label' => 'Pounds',
        'unit' => 'lb',
        'factor' => 0.45359237,
        'type' => 'weight',
      ],
      'kilograms' => [
        'id' => 'kilograms',
        'label' => 'Kilograms',
        'unit' => 'kg',
        'factor' => 1,
        'type' => 'weight',
      ],
    ];

    $this->unitPluginManager = $this->getMockBuilder('\Drupal\physical\UnitManager')
      ->disableOriginalConstructor()->getMock();
    $this->unitPluginManager->expects($this->any())
      ->method('getDefinitions')
      ->willReturn($definitions);
    $this->unitPluginManager->expects($this->at(1))
      ->method('createInstance')
      ->with('pounds', $this->anything())
      ->willReturn(new Unit([], 'pounds', $definitions['pounds']));
    $this->unitPluginManager->expects($this->at(2))
      ->method('createInstance')
      ->with('kilograms', $this->anything())
      ->willReturn(new Unit([], 'kilograms', $definitions['kilograms']));

    $this->weight = new Weight($this->unitPluginManager);
  }

  /**
   * Test weight can take a value.
   *
   * @covers ::setWeight
   */
  public function testSetWeight() {
    $this->weight->setWeight(135, 'lb');
  }

  /**
   * Test weight can take a value.
   *
   * @covers ::setWeight
   * @covers ::getWeight
   */
  public function testGetWeight() {
    $this->weight->setWeight(135, 'lb');
    $this->assertEquals(135, $this->weight->getWeight('lb'));
  }

  /**
   * Test weight can take a value.
   *
   * @covers ::setWeight
   * @covers ::getWeight
   */
  public function testGetWeightConversion() {
    $this->weight->setWeight(135, 'lb');
    $this->assertEquals(61.23497, $this->weight->getWeight('kg'));
  }

}
