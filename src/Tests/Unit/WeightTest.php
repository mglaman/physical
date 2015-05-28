<?php

/**
 * @file
 * Contains \Drupal\physical\Tests\Unit\WeightTest.
 */

namespace Drupal\physical\Tests\Unit;

use Drupal\physical\Physical\Weight;
use Drupal\physical\UnitPluginInterface;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\physical\Unit\Unit
 * @group physical
 */
class WeightTest extends UnitTestCase {
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

  protected $weight;

  /**
   * {@inheritdoc}
   *
   * @covers ::__construct
   */
  protected function setUp() {
    parent::setUp();
    $this->weight = new Weight();
    $this->unitLb = $this->weight->getUnit('lb');
    $this->unitOz = $this->weight->getUnit('oz');
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
