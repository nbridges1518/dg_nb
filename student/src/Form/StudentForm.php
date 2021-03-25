<?php 

/**
 * @file
 * Contains \Drupal\student\Form\StudentForm.
 */

namespace Drupal\student\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class StudentForm extends FormBase {
      
  /**
   * {@inheritdoc}
   */

  public function getFormId() {
    return 'student_form';
  }

function upei_preprocess_page(&$variables) {
    if(!$variables['user']->uid && arg(0)!='user' && arg(1)!='login') {
        drupal_goto('user/login');
    }
}

  /**
   * {@inheritdoc}
   */

  public function buildForm(array $form, FormStateInterface $form_state) {
      
  $current_user = \Drupal::currentUser()->getAccountName();
  $id_user = \Drupal::currentUser()->id();

  $form['uid'] = array(
      '#type' => 'hidden',
      '#title' => t('User ID:'),
      '#default_value' => "$id_user",
      '#required' => TRUE,
    );
   $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Student Name:'),
      '#default_value' => "$current_user",
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Email Address:'),
      '#required' => TRUE,
    );
    $form['phone'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile Number:'),
    );
    $form['dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB:'),
      '#required' => TRUE,
    );    
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'), 
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */

  public function validateForm(array &$form, FormStateInterface $form_state) {

  if (strlen($form_state->getValue('phone')) < 10) {
        $form_state->setErrorByName('phone', $this->t('Mobile number is too short.'));
     }	    
    }
 
 /**
   * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $data = array(
      'uid' => $form_state->getValue('uid'),	  
      'name' => $form_state->getValue('name'),
      'email' => $form_state->getValue('email'),
      'phone' => $form_state->getValue('phone'),
      'dob' => $form_state->getValue('dob')
      );

  //insert data to database
  \Drupal::database()->insert('student')->fields($data)->execute();

  // show message and redirect to list page
  \Drupal::messenger()->addStatus('Succesfully saved');
  }
 }
