<?php

namespace Drupal\physical\Plugin\Field\FieldWidget;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'physical_volume_default' widget.
 *
 * @FieldWidget(
 *   id = "physical_dimension_default",
 *   label = @Translation("Physical volume"),
 *   field_types = {
 *     "physical_dimensions"
 *   },
 *   measurement = "dimensions"
 * )
 */
class DimensionsDefaultWidget extends PhysicalWidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'default_unit' => 'in',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // Determine the default dimensions value.
    $value = [];
    foreach (array_keys($this->physicalMeasurement->getComponents()) as $key) {
      $value += [$key => ''];
    }
    $value += ['unit' => $this->defaultUnit()];

    if (isset($items[$delta]->length)) {
      $value = [
        'length' => round($items[$delta]->length, 5),
        'width' => round($items[$delta]->width, 5),
        'height' => round($items[$delta]->height, 5),
        'unit' => $items[$delta]->unit,
      ];
    }

    // Add textfields for the dimensions values.
    $element['#type'] = 'fieldset';
    $element['#attributes']['class'][] = 'physical-dimensions-textfields';

    foreach (array_keys($this->physicalMeasurement->getComponents()) as $key) {
      $element[$key] = [
        '#type' => 'textfield',
        '#title' => strtoupper($key),
        '#default_value' => $value[$key],
        '#size' => 15,
        '#maxlength' => 16,
        '#required' => $element['#required'] && ($delta == 0 || $this->getFieldSetting('cardinality') > 0),
        '#field_suffix' => '&times;',
        '#prefix' => '<div class="physical-dimension-form-item">',
        '#suffix' => '</div>',
      ];
    }

    // If the user cannot select a different unit of measurement and the current
    // unit is the same as the default...
    if (!$this->allowUnitChange() && $value['unit'] == $this->defaultUnit()) {
      // Display the unit of measurement after the textfield.
      $element['height']['#field_suffix'] = $this->physicalMeasurement->getUnit($this->defaultUnit())->getUnit();

      // Add a hidden value for the default unit of measurement.
      $element['unit'] = [
        '#type' => 'value',
        '#value' => $value['unit'],
      ];
    }
    else {
      // Get an options list of dimension units of measurement.
      $options = $this->unitOptions();

      // If the user isn't supposed to have access to select a unit of
      // measurement, only allow the default and the current unit.
      if (!$this->allowUnitChange()) {
        $options = array_intersect_key($options, $this->defaultUnit());
      }

      // Display a unit of measurement select list after the textfield.
      $element['unit'] = [
        '#type' => 'select',
        '#options' => $options,
        '#default_value' => $value['unit'],
        '#prefix' => '<div class="physical-dimensions-unit-form-item">',
        '#suffix' => '</div>',
      ];
    }

    return $element;
  }

}
