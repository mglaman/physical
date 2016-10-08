<?php

namespace Drupal\physical\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\physical\Physical\Weight;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;

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
class WeightDefaultWidget extends PhysicalWidgetBase {

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);
  }

  /**
   * {@inheritdoc}
   */
  protected function getPhysicalQuantityClass() {
    return Mass::class;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['weight'] = $element + [
      '#type' => 'textfield',
      '#title' => $element['#title'],
      '#default_value' => isset($items[$delta]->weight) ? round($items[$delta]->weight, 5) : NULL,
    ];

    $unit = (isset($items[$delta]->unit)) ? isset($items[$delta]->unit) : $this->defaultUnit();

    // If the user cannot select a different unit of measurement and the current
    // unit is the same as the default...
    if (!$this->allowUnitChange() && $unit == $this->defaultUnit()) {
      // Display the unit of measurement after the textfield.
      $class = $this->getPhysicalQuantityClass();
      $element['weight']['#field_suffix'] = $class::getUnit($unit)->getName();

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
      // Display a unit of measurement select list after the textfield.
      $element['weight']['#prefix'] = '<div class="physical-weight-textfield">';

      $element['unit'] = [
        '#type' => 'select',
        '#options' => $this->unitOptions(),
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
