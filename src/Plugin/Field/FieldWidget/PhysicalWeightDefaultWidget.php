<?php

/**
 * @file
 * Contains \Drupal\physical\Field\FieldWidget\PhysicalWeightDefaultWidget.
 */

namespace Drupal\physical\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\physical\Physical\Weight;

/**
 * Plugin implementation of the 'physical_weight_default' widget.
 *
 * @FieldWidget(
 *   id = "physical_weight_default",
 *   label = @Translation("Physical weight"),
 *   field_types = {
 *     "physical_weight"
 *   }
 * )
 */
class PhysicalWeightDefaultWidget extends PhysicalWidgetBase {

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);
    $this->physicalObject = new Weight();
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'default_unit' => 'lb',
      'unit_select_list' => TRUE,
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['default_unit'] = array(
      '#type' => 'select',
      '#title' => $this->t('Unit of measurement'),
      '#options' => $this->unitOptions(),
      '#default_value' => $this->getSetting('default_unit'),
    );

    $element['unit_select_list'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Allow the user to select a different unit of measurement on forms.'),
      '#default_value' => $this->getSetting('unit_select_list'),
    );
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // Determine the default weight value.
    if (isset($items[$delta]->weight)) {
      $weight = round($items[$delta]->weight, 5);
    }
    elseif (isset($instance['default_value'][0]['weight']) && ($delta == 0 || $this->getFieldSetting('cardinality') > 0)) {
      $weight = round($instance['default_value'][0]['weight'], 5);
    }
    else {
      $weight = '';
    }

    // Add a textfield for the actual weight value.
    $element['weight'] = array(
      '#type' => 'textfield',
      '#title' => $element['#title'],
      '#default_value' => $weight,
      '#size' => 15,
      '#maxlength' => 16,
      '#required' => $element['#required'] && ($delta == 0 || $this->getFieldSetting('cardinality') > 0),
    );

    // Determine the unit of measurement.
    if (!empty($items[$delta]->unit)) {
      $unit = $items[$delta]->unit;
    }
    elseif (!$this->allowUnitChange() && !empty($instance['default_value'][0]['unit'])) {
      $unit = $instance['default_value'][0]['unit'];
    }
    else {
      $unit = $this->defaultUnit();
    }

    // If the user cannot select a different unit of measurement and the current
    // unit is the same as the default...
    if (!$this->allowUnitChange() && $unit == $this->defaultUnit()) {
      // Display the unit of measurement after the textfield.
      $element['weight']['#field_suffix'] = $this->physicalObject->getUnit($unit)->getUnit();

      if (!empty($element['#description'])) {
        $element['weight']['#suffix'] = '<div class="description">' . $element['#description'] . '</div>';
      }

      // Add a hidden value for the default unit of measurement.
      $element['unit'] = array(
        '#type' => 'value',
        '#value' => $unit,
      );
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

      $element['unit'] = array(
        '#type' => 'select',
        '#options' => $options,
        '#default_value' => $unit,
        '#suffix' => '</div>',
      );

      if (!empty($element['#description'])) {
        $element['unit']['#suffix'] = '<div class="description">' . $element['#description'] . '</div></div>';
      }
    }

    return $element;
  }

}
