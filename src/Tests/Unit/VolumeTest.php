<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\Unit\WeightTest.
 */

namespace Drupal\physical\Tests\Unit;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\physical\Physical\Volume;
use Drupal\Tests\UnitTestCase;
use Drupal\physical\Unit;

/**
 * @coversDefaultClass \Drupal\physical\Physical\Volume
 * @group physical
 */
class VolumeTest extends UnitTestCase {

  /**
   * The mock unit plugin manager.
   *
   * @var \Drupal\physical\UnitManagerInterface|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $unitPluginManager;

  /**
   * Volume physical object.
   *
   * @var Volume
   */
  protected $volume;

  /**
   * {@inheritdoc}
   *
   * @covers ::__construct
   */
  protected function setUp() {
    parent::setUp();

    $definitions = [
      'cubic_meter' => [
        'id' => 'cubic_meter',
        'label' => 'Cubic meter',
        'unit' => 'm³',
        'factor' => 1,
        'type' => 'volume',
      ],
      'cup' => [
        'id' => 'cup',
        'label' => 'Cup',
        'unit' => 'cup',
        'factor' => 2.365882e-4,
        'type' => 'volume',
      ],
    ];

    $this->unitPluginManager = $this->getMock('\Drupal\physical\UnitManagerInterface');
    $this->unitPluginManager->expects($this->any())
                            ->method('getDefinitions')
                            ->willReturn($definitions);
    $this->unitPluginManager->expects($this->at(1))
                            ->method('createInstance')
                            ->with('cubic_meter', $this->anything())
                            ->willReturn(new Unit(array(), 'cubic_meter', $definitions['cubic_meter']));
    $this->unitPluginManager->expects($this->at(2))
                            ->method('createInstance')
                            ->with('cup', $this->anything())
                            ->willReturn(new Unit(array(), 'cup', $definitions['cup']));

    $container = new ContainerBuilder();
    $container->set('plugin.manager.unit', $this->unitPluginManager);
    \Drupal::setContainer($container);

    $this->volume = new Volume();
  }

  /**
   * Test volume can take a value.
   *
   * @covers ::setVolume
   */
  public function testSetVolume() {
    $this->volume->setVolume(135, 'm³');
  }

  /**
   * Test volume can get a value.
   *
   * @covers ::setVolume
   * @covers ::getVolume
   */
  public function testGetWeight() {
    $this->volume->setVolume(135, 'm³');
    $this->assertEquals(135, $this->volume->getVolume('m³'));
  }

  /**
   * Test volume can convert a value.
   *
   * @covers ::setVolume
   * @covers ::getVolume
   */
  public function testGetWeightConversion() {
    $this->volume->setVolume(135, 'm³');
    $this->assertEquals(570611.72113, $this->volume->getVolume('cup'));
  }

}
