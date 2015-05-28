<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\Unit\WeightTest.
 */

namespace Drupal\physical\Tests\Unit;

use Drupal\physical\Physical\Volume;
use Drupal\physical\UnitPluginInterface;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\physical\Unit\Unit
 * @group physical
 */
class VolumeTest extends UnitTestCase {
  /**
   * Cubic meter unit.
   *
   * @var UnitPluginInterface
   */
  protected $unitCubicMeter;
  /**
   * Cup unit.
   *
   * @var UnitPluginInterface
   */
  protected $unitCup;

  protected $volume;

  /**
   * {@inheritdoc}
   *
   * @covers ::__construct
   */
  protected function setUp() {
    parent::setUp();
    $this->volume = new Volume();
    $this->unitCubicMeter = $this->volume->getUnit('m³');
    $this->unitCup = $this->volume->getUnit('cup');
  }

  /**
   * Test that cup converts to cubic meter.
   *
   * @covers ::toBase
   */
  public function testCupToCubicMeter() {
    $this->assertEquals(0.00024, $this->unitCup->toBase(1));
    $this->assertEquals(0.00118, $this->unitCup->toBase(5));
  }

  /**
   * Test that cubic meter converts to cup.
   *
   * @covers ::fromBase
   */
  public function testCubicMeterToCup() {
    $this->assertEquals(4226.75349, $this->unitCup->fromBase(1));
  }

}
