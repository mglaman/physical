<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\Unit\WeightTest.
 */

namespace Drupal\physical\Tests\Unit;

use Drupal\physical\Unit\Unit;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\physical\Unit\Unit
 * @group physical
 */
class VolumeTest extends UnitTestCase {
  /**
   * Cubic meter unit.
   *
   * @var Unit
   */
  protected $unitCubicMeter;
  /**
   * Cup unit.
   *
   * @var Unit
   */
  protected $unitCup;

  /**
   * {@inheritdoc}
   *
   * @covers ::__construct
   */
  protected function setUp() {
    parent::setUp();
    $this->unitCubicMeter = new Unit('Cubic meter', 'm³', 1);
    $this->unitCup = new Unit('Cup', 'cup', 2.365882e-4);
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
