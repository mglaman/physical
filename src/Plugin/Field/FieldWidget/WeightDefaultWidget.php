<?php

namespace Drupal\physical\Plugin\Field\FieldWidget;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'physical_weight_default' widget.
 *
 * @FieldWidget(
 *   id = "physical_weight_default",
 *   label = @Translation("Physical weight"),
 *   field_types = {
 *     "physical_weight"
 *   }
 *   measurement = "weight"
 * )
 */
class WeightDefaultWidget extends PhysicalWidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'default_unit' => 'lb',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // Determine the default weight value.
    $weight = '';
    if (isset($items[$delta]->weight)) {
      $weight = round($items[$delta]->weight, 5);
    }

    // Add a textfield for the actual weight value.
    $element['weight'] = $element + [
      '#type' => 'textfield',
      '#default_value' => $weight,
    ];

    // Determine the unit of measurement.
    $unit = $this->defaultUnit();
    if (!empty($items[$delta]->unit)) {
      $unit = $items[$delta]->unit;
    }

    // If the user cannot select a different unit of measurement and the current
    // unit is the same as the default...
    if (!$this->allowUnitChange() && $unit == $this->defaultUnit()) {
      // Display the unit of measurement after the textfield.
      $element['weight']['#field_suffix'] = $unit;

      if (!empty($element['#description'])) {
        $element['weight']['#suffix'] = '<div class="description">' . $element['#description'] . '</div>';
      }

      // Add a hidden value for the default unit of measurement.
      $element['unit'] = [
        '#type' => 'value',
        '#value' => $unit,
      ];
    }
    else {
      // Get an options list of weight units of measurement.
      $options = $this->unitOptions();

      // If the user isn't supposed to have access to select a unit of
      // measurement, only allow the default and the current unit.
      if (!$this->allowUnitChange()) {
        $options = array_intersect_key($options, $this->defaultUnit());
      }

      // Display a unit of measurement select list after the textfield.
      $element['weight']['#prefix'] = '<div class="physical-weight-textfield">';

      $element['unit'] = [
        '#type' => 'select',
        '#options' => $options,
        '#default_value' => $unit,
        '#suffix' => '</div>',
      ];

      if (!empty($element['#description'])) {
        $element['unit']['#suffix'] = '<div class="description">' . $element['#description'] . '</div></div>';
      }
    }

    return $element;
  }

}
