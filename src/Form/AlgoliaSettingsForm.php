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

    $form['indexname'] = [
      '#type' => 'textfield',
      '#title' => 'Index name',
      '#placeholder' => 'Index name',
      '#default_value' => !empty($default_values['indexname']) ? $default_values['indexname'] : '',
    ];

    $form['appId'] = [
      '#type' => 'textfield',
      '#title' => 'App Id',
      '#placeholder' => 'App Id',
      '#default_value' => !empty($default_values['appId']) ? $default_values['appId'] : '',
    ];

    $form['apiKey'] = [
      '#type' => 'textfield',
      '#title' => 'Api key',
      '#placeholder' => 'Api key',
      '#default_value' => !empty($default_values['apiKey']) ? $default_values['apiKey'] : '',
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

    \Drupal::state()->set('algolia_settings', $values);
    $messenger = \Drupal::messenger();
    $messenger->addMessage('Algolia configurations saved', $messenger::TYPE_STATUS);

  }

}
