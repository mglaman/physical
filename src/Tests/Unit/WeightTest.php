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
class WeightTest extends UnitTestCase {
  /**
   * Pounds unit.
   *
   * @var Unit
   */
  protected $unitLb;
  /**
   * Ounces unit.
   *
   * @var Unit
   */
  protected $unitOz;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->unitLb = new Unit('Pounds', 'lb', 0.45359237);
    $this->unitOz = new Unit('Ounces', 'oz', 2.83495E-2);
  }

  /**
   * Test pound to kilogram conversion.
   */
  public function testLbToKg() {
    $this->assertEquals(0.45359, $this->unitLb->toBase(1));
    $this->assertEquals(61.23497, $this->unitLb->toBase(135));
  }

  /**
   * Test kilogram to pound conversion.
   */
  public function testKgToLb() {
    $this->assertEquals(2.20462, $this->unitLb->fromBase(1));
    $this->assertEquals(135, $this->unitLb->fromBase(61.23497));
  }

  /**
   * Test ounces to pound conversion.
   */
  public function testOzToLb() {
    $this->assertEquals(0.25, $this->unitLb->fromBase($this->unitOz->toBase(4)));
  }

}
