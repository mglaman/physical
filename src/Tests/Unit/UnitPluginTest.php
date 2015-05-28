<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\Unit\UnitPluginTest.
 */

namespace Drupal\physical\Tests\Unit;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\physical\Unit;
use Drupal\physical\UnitPluginInterface;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\physical\Unit
 * @group physical
 *
 * @todo: Get manager working.
 */
class UnitPluginTest extends UnitTestCase {

  /**
   * The mock unit plugin manager.
   *
   * @var \Drupal\physical\UnitManagerInterface|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $unitPluginManager;

  /**
   * Pounds unit.
   *
   * @var UnitPluginInterface
   */
  protected $unitLb;
  /**
   * Ounces unit.
   *
   * @var UnitPluginInterface
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

    $this->unitPluginManager = $this->getMock('\Drupal\physical\UnitManagerInterface');
    $this->unitPluginManager->expects($this->any())
                        ->method('getDefinitions')
                        ->willReturn($definitions);

    $container = new ContainerBuilder();
    $container->set('plugin.manager.unit', $this->unitPluginManager);
    \Drupal::setContainer($container);

    $this->unitLb = new Unit(array(), 'pound', $definitions['pounds']);
    $this->unitOz = new Unit(array(), 'ounces', $definitions['ounces']);
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
