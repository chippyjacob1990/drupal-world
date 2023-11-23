<?php

namespace Drupal\several_forms\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\AlertCommand;

class CustomUserDetails extends FormBase {

    public function getFormId() {
        return "custom_user_details_form";
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['#attached']['library'][] = "several_forms/customjsform";
        $form['username'] = [
            '#type' => 'textfield',
            '#title' => 'User Name',
            '#required' => true,
        ];
        $form['usermail'] = [
            '#type' => 'email',
            '#title' => 'Email',
            '#required' => true,
            /*'#ajax' => [
                'callback' => '::setAjaxSubmit',
                'event' => 'keyup',
            ],*/
        ];
        $form['usergender'] = [
            '#type' => 'select',
            '#title' => 'Gender',
            '#options' => [
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other'
            ],
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Submit',
            '#ajax' => [
                'callback' => '::setAjaxSubmit',
            ],
        ];

        return $form;
    }

    public function setAjaxSubmit() {
        $response = new AjaxResponse();
        //$response->addCommand(new AlertCommand("dsfsdfsd"));
        //$response->addCommand(new InvokeCommand("#custom-user-details-form", 'addClass', ['dd']));
        $response->addCommand(new InvokeCommand("#custom-user-details-form", 'datacheck'));
        return $response;
    }
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if (strlen($form_state->getValue('username')) < 6) {
            $form_state->setErrorByname('username', "please make sure your username length is more than 5");
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        \Drupal::messenger()->addMessage("User Details Submitted Successfully");
        $values = $form_state->getValues();
        \Drupal::database()->insert('user_details')->fields([
            'name' => $values['username'],
            'mail' => $values['usermail'],
            'gender' => $values['usergender'],
        ])->execute();
    }
}
