<?php

namespace Drupal\Tests\physical\Unit;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\physical\Plugin\Physical\Unit;
use Drupal\Tests\UnitTestCase;

/**
 * Tests the Unit plugin.
 *
 * @coversDefaultClass \Drupal\physical\Plugin\Physical\Unit
 * @group physical
 */
class UnitPluginTest extends UnitTestCase {

  /**
   * The mock unit plugin manager.
   *
   * @var \Drupal\physical\UnitManager|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $unitPluginManager;

  /**
   * Pounds unit.
   *
   * @var \Drupal\physical\Plugin\Physical\UnitInterface
   */
  protected $unitLb;
  /**
   * Ounces unit.
   *
   * @var \Drupal\physical\Plugin\Physical\UnitInterface
   */
  protected $unitOz;

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
      'ounces' => [
        'id' => 'ounces',
        'label' => 'Ounces',
        'unit' => 'oz',
        'factor' => 2.83495E-2,
        'type' => 'weight',
      ],
    ];

    $this->unitPluginManager = $this->getMockBuilder('\Drupal\physical\UnitManager')
      ->disableOriginalConstructor()->getMock();
    $this->unitPluginManager->expects($this->any())
      ->method('getDefinitions')
      ->willReturn($definitions);

    $container = new ContainerBuilder();
    $container->set('plugin.manager.unit', $this->unitPluginManager);
    \Drupal::setContainer($container);

    $this->unitLb = new Unit([], 'pound', $definitions['pounds']);
    $this->unitOz = new Unit([], 'ounces', $definitions['ounces']);
  }

  /**
   * Test pound to kilogram conversion.
   *
   * @covers ::toBase
   */
  public function testLbToKg() {
    $this->assertEquals(0.45359, $this->unitLb->toBase(1));
    $this->assertEquals(61.23497, $this->unitLb->toBase(135));
  }

  /**
   * Test kilogram to pound conversion.
   *
   * @covers ::fromBase
   */
  public function testKgToLb() {
    $this->assertEquals(2.20462, $this->unitLb->fromBase(1));
    $this->assertEquals(135, $this->unitLb->fromBase(61.23497));
  }

  /**
   * Test ounces to pound conversion.
   *
   * @covers ::fromBase
   * @covers ::toBase
   */
  public function testOzToLb() {
    $this->assertEquals(0.25, $this->unitLb->fromBase($this->unitOz->toBase(4)));
  }

}
