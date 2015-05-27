<?php

/**
 * @file
 * Contains \Drupal\physicalPlugin\Field\FieldWidget\PhysicalWidgetBase.
 */

namespace Drupal\physical\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;


/**
 * Class PhysicalWidgetBase.
 */
abstract class PhysicalWidgetBase extends WidgetBase {

  /**
   * Physical object.
   *
   * @var \Drupal\physical\PhysicalInterface
   */
  protected $physicalObject;

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $summary[] = $this->t('Unit of measurement: @unit', array('@unit' => $this->getSetting('default_unit')));

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
    foreach ($this->physicalObject->getUnits() as $key => $unit) {
      $options[$key] = $unit->getLabel();
    }
    return $options;
  }

}
