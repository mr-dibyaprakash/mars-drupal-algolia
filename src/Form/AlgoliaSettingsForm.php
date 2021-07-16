<?php

namespace Drupal\algolia_search_interface\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * This will be used to store algolia settings.
 */
class AlgoliaSettingsForm extends FormBase {

  /**
   * For algolia settings form.
   *
   * @return string
   *   ID form
   */
  public function getFormId() {
    return 'algoliasettings_form';
  }

  /**
   * This is a form built for algolia settings form
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return string
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $default_values = \Drupal::state()->get('algolia_settings');

    $template_placeholder = '<div>
    <img src="{{image}}" align="left" alt="{{name}}" />
    <div class="hit-name">
      {{#helpers.highlight}}{ "attribute": "name" }{{/helpers.highlight}}
    </div>
    <div class="hit-description">
      {{#helpers.highlight}}{ "attribute": "description" }{{/helpers.highlight}}
    </div>
    <div class="hit-price">\${{price}}</div>
  </div>';

    $form['indexname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Index name'),
      '#placeholder' => 'Index name',
      '#default_value' => !empty($default_values['indexname']) ? $default_values['indexname'] : '',
      '#required' => TRUE,
    ];

    $form['appId'] = [
      '#type' => 'textfield',
      '#title' => $this->t('App Id'),
      '#placeholder' => 'App Id',
      '#default_value' => !empty($default_values['appId']) ? $default_values['appId'] : '',
      '#required' => TRUE,
    ];

    $form['apiKey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Api key'),
      '#placeholder' => 'Api key',
      '#default_value' => !empty($default_values['apiKey']) ? $default_values['apiKey'] : '',
      '#required' => TRUE,
    ];
    
    $form['template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Template'),
      '#description' => $this->t('Add your attributes from algolia in this format {{attribute}} within your html elements'),
      '#placeholder' => $template_placeholder,
      '#default_value' => !empty($default_values['template']) ? $default_values['template'] : '',
      '#required' => TRUE,
    ];

    $form['pagination'] = [
      '#type' => 'radios',
      '#title' => $this->t('Activate pagination'),
      '#default_value' => !empty($default_values['pagination']) ? $default_values['pagination'] : '',
      '#options' => array(
        0 => $this
          ->t('Off'),
        1 => $this
          ->t('On'),
      )
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    
    return $form;
  }

  /**
   * To validate form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $values = $form_state->getValues();

  }

  /**
   * To submit form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    $values = [];
    $values['indexname'] = $form_state->getValue('indexname');
    $values['appId'] = $form_state->getValue('appId');
    $values['apiKey'] = $form_state->getValue('apiKey');
    $values['template'] = $form_state->getValue('template');
    $values['pagination'] = $form_state->getValue('pagination');

    \Drupal::state()->set('algolia_settings', $values);
    $messenger = \Drupal::messenger();
    $messenger->addMessage('Algolia configurations saved', $messenger::TYPE_STATUS);

  }

}
