<?php

/**
 * @file
 * Contains .
 */

namespace Drupal\physical;

use Drupal\Component\Plugin\CategorizingPluginManagerInterface;

/**
 * Provides an interface for the discovery and instantiation of unit plugins.
 */
interface UnitManagerInterface extends CategorizingPluginManagerInterface {
  /**
   * {@inheritdoc}
   *
   * @return UnitPluginInterface
   *    A unit plugin.
   */
  public function createInstance($plugin_id, array $configuration = array());

}
