<?php

namespace Drupal\physical;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Interface for the physical unit plugin manager.
 */
interface UnitManagerInterface extends PluginManagerInterface {

  /**
   * Gets unit plugins by type.
   *
   * @param string $type
   *    Measurement type.
   *
   * @return \Drupal\physical\Plugin\Physical\UnitInterface[]
   *    Returns array of unit plugins.
   */
  public function getByType($type);

}
