<?php

/**
 * @file
 * Contains \Drupal\physical\Field\FieldWidget\PhysicalVolumeDefaultWidget.
 */

namespace Drupal\physical\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\physical\Volume;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'physical_volume_default' widget.
 *
 * @FieldWidget(
 *   id = "physical_volume_default",
 *   label = @Translation("Physical volume"),
 *   field_types = {
 *     "physical_volume"
 *   }
 * )
 */
class PhysicalVolumeDefaultWidget extends PhysicalWidgetBase {

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);
    $this->physicalObject = new Volume();
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'default_unit' => 'in',
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
      '#default_value' => $this->defaultUnit(),
    );

    $element['unit_select_list'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Allow the user to select a different unit of measurement on forms.'),
      '#default_value' => $this->allowUnitChange(),
    );
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // Determine the default dimensions value.
    $value = array();

    if (isset($items[$delta]->length)) {
      $value = array(
        'length' => round($items[$delta]->length, 5),
        'width' => round($items[$delta]->width, 5),
        'height' => round($items[$delta]->height, 5),
        'unit' => $items[$delta]->unit,
      );
    }
    elseif (isset($instance['default_value'][0]['length']) && ($delta == 0 || $this->getFieldSetting('cardinality') > 0)) {
      $value = $instance['default_value'][0];

      if (!$this->allowUnitChange()) {
        unset($value['unit']);
      }
    }

    // Ensure the value array defines every expected key.
    foreach (array_keys($this->physicalObject->getComponents()) as $key) {
      $value += array($key => '');
    }

    $value += array('unit' => $this->defaultUnit());

    // Add textfields for the dimensions values.
    $element['#type'] = 'fieldset';
    $element['#attributes']['class'][] = 'physical-dimensions-textfields';

//    $element['#attached']['css'][] = drupal_get_path('module', 'physical') . '/theme/physical.css';

    foreach (array_keys($this->physicalObject->getComponents()) as $key) {
      $element[$key] = array(
        '#type' => 'textfield',
        '#title' => strtoupper($key),
        '#default_value' => $value[$key],
        '#size' => 15,
        '#maxlength' => 16,
        '#required' => $element['#required'] && ($delta == 0 || $this->getFieldSetting('cardinality') > 0),
        '#field_suffix' => '&times;',
        '#prefix' => '<div class="physical-dimension-form-item">',
        '#suffix' => '</div>',
      );
    }

    // Remove the suffix from the last dimension element.
//    unset($element[$key]['#field_suffix']);

    // If the user cannot select a different unit of measurement and the current
    // unit is the same as the default...
    if (!$this->allowUnitChange() && $value['unit'] == $this->defaultUnit()) {
      // Display the unit of measurement after the textfield.
      $element['height']['#field_suffix'] = $this->physicalObject->getUnit($this->defaultUnit())->getUnit();

      // Add a hidden value for the default unit of measurement.
      $element['unit'] = array(
        '#type' => 'value',
        '#value' => $value['unit'],
      );
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
      $element['unit'] = array(
        '#type' => 'select',
        '#options' => $options,
        '#default_value' => $value['unit'],
        '#prefix' => '<div class="physical-dimensions-unit-form-item">',
        '#suffix' => '</div>',
      );
    }

    return $element;
  }

}
