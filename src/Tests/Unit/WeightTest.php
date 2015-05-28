<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\Unit\WeightTest.
 */

namespace Drupal\physical\Tests\Unit;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\physical\Physical\Weight;
use Drupal\Tests\UnitTestCase;
use Drupal\physical\Unit;

/**
 * @coversDefaultClass \Drupal\physical\Physical\Weight
 * @group physical
 */
class WeightTest extends UnitTestCase {

  /**
   * The mock unit plugin manager.
   *
   * @var \Drupal\physical\UnitManagerInterface|\PHPUnit_Framework_MockObject_MockObject
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

    $this->unitPluginManager = $this->getMock('\Drupal\physical\UnitManagerInterface');
    $this->unitPluginManager->expects($this->any())
                            ->method('getDefinitions')
                            ->willReturn($definitions);
    $this->unitPluginManager->expects($this->at(1))
      ->method('createInstance')
      ->with('pounds', $this->anything())
      ->willReturn(new Unit(array(), 'pounds', $definitions['pounds']));
    $this->unitPluginManager->expects($this->at(2))
      ->method('createInstance')
      ->with('kilograms', $this->anything())
      ->willReturn(new Unit(array(), 'kilograms', $definitions['kilograms']));

    $container = new ContainerBuilder();
    $container->set('plugin.manager.unit', $this->unitPluginManager);
    \Drupal::setContainer($container);

    $this->weight = new Weight();
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
