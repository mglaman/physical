<?php

namespace Drupal\physical;

use Drupal\Component\Plugin\Exception\PluginException;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Plugin\Discovery\ContainerDerivativeDiscoveryDecorator;
use Drupal\Core\Plugin\Discovery\YamlDiscovery;

/**
 * Class UnitManager.
 */
class UnitManager extends DefaultPluginManager implements UnitManagerInterface {

  /**
   * Default values for each unit plugin.
   *
   * @var array
   */
  protected $defaults = [
    'id' => '',
    'label' => '',
    'unit' => '',
    'factor' => 0.00,
    'type' => '',
    'class' => 'Drupal\physical\Plugin\Physical\Unit',
  ];

  /**
   * Constructs a new \Drupal\physical\UnitManager object.
   *
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $this->moduleHandler = $module_handler;
    $this->setCacheBackend($cache_backend, 'physical_unit_plugins', ['physical_unit']);
  }

  /**
   * {@inheritdoc}
   */
  protected function getDiscovery() {
    if (!isset($this->discovery)) {
      $this->discovery = new YamlDiscovery('physical_unit', $this->moduleHandler->getModuleDirectories());
      $this->discovery->addTranslatableProperty('label');
      $this->discovery = new ContainerDerivativeDiscoveryDecorator($this->discovery);
    }
    return $this->discovery;
  }

  /**
   * {@inheritdoc}
   */
  public function processDefinition(&$definition, $plugin_id) {
    parent::processDefinition($definition, $plugin_id);

    $definition['id'] = $plugin_id;
    foreach (['unit', 'factor', 'type'] as $required_property) {
      if (empty($definition[$required_property])) {
        throw new PluginException(sprintf('The physical unit %s must define the %s property.', $plugin_id, $required_property));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getUnitsForType($type) {
    $units = [];
    foreach ($this->getDefinitions() as $id => $plugin) {
      if ($plugin['type'] == $type) {
        $units[$id] = $this->createInstance($id, $plugin);
      }
    }
    return $units;
  }

  /**
   * {@inheritdoc}
   */
  public function getUnit($unit) {
    foreach ($this->getDefinitions() as $plugin_id => $definition) {
      if ($definition['unit'] == $unit) {
        return $this->createInstance($plugin_id);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function convertValue($value, $from, $to) {
    /** @var \Drupal\physical\Plugin\Physical\UnitInterface $from_unit */
    if (!$from_unit = $this->getUnit($from)) {
      throw new PluginException("Invalid physical unit $from");
    }
    /** @var \Drupal\physical\Plugin\Physical\UnitInterface $to_unit */
    if (!$to_unit = $this->getUnit($to)) {
      throw new PluginException("Invalid physical unit $to");
    }

    return $to_unit->round($to_unit->fromBase($from_unit->toBase($value)));
  }

}
