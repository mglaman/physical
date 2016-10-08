<?php

namespace Drupal\physical\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\physical\UnitManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class PhysicalWidgetBase.
 */
abstract class PhysicalWidgetBase extends WidgetBase implements ContainerFactoryPluginInterface {

  /**
   * The physical unit manager.
   *
   * @var \Drupal\physical\UnitManagerInterface
   */
  protected $unitManager;

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings, UnitManagerInterface $unit_manager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);
    $this->unitManager = $unit_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    // @see \Drupal\Core\Field\WidgetPluginManager::createInstance().
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['third_party_settings'],
      $container->get('plugin.manager.unit')
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'default_unit' => '',
      'unit_select_list' => TRUE,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['default_unit'] = [
      '#type' => 'select',
      '#title' => $this->t('Unit of measurement'),
      '#options' => $this->unitOptions(),
      '#default_value' => $this->defaultUnit(),
    ];

    $element['unit_select_list'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow the user to select a different unit of measurement on forms.'),
      '#default_value' => $this->allowUnitChange(),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Unit of measurement: @unit', ['@unit' => $this->getSetting('default_unit')]);

    if (!$this->allowUnitChange()) {
      $summary[] = $this->t('User cannot modify the unit of measurement.');
    }
    else {
      $summary[] = $this->t('User can modify the unit of measurement.');
    }

    return $summary;
  }

  /**
   * Helper to return default unit from settings.
   *
   * @return mixed|null
   *    Default unit abbreviation.
   */
  protected function defaultUnit() {
    return $this->getSetting('default_unit');
  }

  /**
   * Helper to return if user can modify unit.
   *
   * @return bool
   *   True or false.
   */
  protected function allowUnitChange() {
    return (bool) $this->getSetting('unit_select_list');
  }

  /**
   * Returns Form API options for select list based on available units.
   *
   * @return array
   *   Array of units.
   */
  protected function unitOptions() {
    $options = [];
    foreach ($this->unitManager->getByType($this->pluginDefinition['measurement']) as $key => $unit) {
      $options[$key] = $unit->getLabel();
    }
    return $options;
  }

}
