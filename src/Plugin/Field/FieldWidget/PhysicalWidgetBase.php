<?php

/**
 * @file
 * Contains \Drupal\physicalPlugin\Field\FieldWidget\PhysicalWidgetBase.
 */

namespace Drupal\physical\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Class PhysicalWidgetBase.
 */
abstract class PhysicalWidgetBase extends WidgetBase {

  /**
   * Gets the class physical quantity class used by the field item.
   *
   * @return \PhpUnitsOfMeasure\AbstractPhysicalQuantity
   *   The physical quantity class.
   */
  abstract protected function getPhysicalQuantityClass();

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'default_unit' => 'lb',
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

    $class = $this->getPhysicalQuantityClass();
    /** @var \PhpUnitsOfMeasure\UnitOfMeasureInterface $definition */
    foreach ($class::getUnitDefinitions() as $definition) {
      $options[$definition->getName()] = $definition->getName();
    }

    return $options;
  }

}
