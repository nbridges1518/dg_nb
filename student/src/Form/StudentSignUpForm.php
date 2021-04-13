<?php
 
 /**
  * Displays link if student is logged in and not signed up for course.
  * php version 7.2.24
  * 
  * @category Custom_Form
  * @package  Student
  * @author   Neil Bridges <neil@discoverygarden.com>
  * @license  test.com  test
  * @link     test
  * @return   /custom/student/src/Form/StudentSignUpForm.php
  */  
 
namespace Drupal\student\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements an example form.
 *    
 * Build Form Description
 *
 * @category Student
 * @package  Student
 * @author   Neil Bridges <neil@discoverygarden.com>
 * @license  student
 * @link     Student 
 * @return   /custom/student/src/Form/StudentSignUpForm.php      
 */ 
class StudentSignUpForm extends FormBase
{
        
    protected $account;

    /**
     * Class constructor.
     * Build Form Description
     *
     * @category Student
     * @package  Student
     * @author   Neil Bridges <neil@discoverygarden.com>
     * @link     Student 
     * @license  student  
     * @return   /custom/student/src/Form/StudentSignUpForm.php      
     */    
 
    public function __construct(AccountInterface $account) 
    {
        $this->account = $account;
    }

    /** 
     * Build Form Description
     *
     * @category Student
     * @package  Student
     * @author   Neil Bridges <neil@discoverygarden.com>
     * @link     Student 
     * @license  student  
     * @return   /custom/student/src/Form/StudentSignUpForm.php      
     */
    public static function create(ContainerInterface $container) 
    {
        // Instantiates this form class.
        return new static(
            // Load the service required to construct this class.
            $container->get('current_user')
        );
    }

    /** 
     * Build Form Description
     *
     * @category Student
     * @package  Student
     * @author   Neil Bridges <neil@discoverygarden.com>
     * @link     Student 
     * @license  student  
     * @return   /custom/student/src/Form/StudentSignUpForm.php      
     */
    public function getFormId() 
    {
        return 'student_sign_up_form';
    }

   
    /** 
     * Build Form Description
     *
     * @category Student
     * @package  Student
     * @author   Neil Bridges <neil@discoverygarden.com>
     * @link     Student 
     * @license  student 
     * $container student
     * $form student
     * $form_state student           
     * @return   /custom/student/src/Form/StudentSignUpForm.php      
     */
    public function buildForm(array $form, FormStateInterface $form_state) 
    {

        // Get current user data.
        $uid = $this->account->id();
        $current_user = $this->account->getAccountName();
                
  
          $form['uid'] = array(
          '#type' => 'hidden',
          '#title' => t('User ID:'),
          '#default_value' => "$uid",
          '#required' => true,
          );
          $form['name'] = array(
          '#type' => 'textfield',
          '#title' => t('Student Name:'),
          '#default_value' => "$current_user",
          '#required' => true,
          );
          $form['email'] = array(
          '#type' => 'email',
          '#title' => t('Email Address:'),
          '#required' => true,
          );
          $form['phone'] = array (
          '#type' => 'tel',
          '#title' => t('Mobile Number:'),
         );
          $form['dob'] = array (
          '#type' => 'date',
          '#title' => t('DOB:'),
          '#required' => true,
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
     * Displays link if student is logged in and not signed up for course.
     * php version 7.2.24
     * 
     * @category Custom_Form
     * @package  Student
     * @author   Neil Bridges <neil@discoverygarden.com>
     * @license  test.com  test
     * @link     test
     * $form       StudentSignUpForm  
     * $form_state active
     * @return   /custom/student/src/Form/StudentSignUpForm.php
     */
    public function submitForm(array &$form, FormStateInterface $form_state) 
    {
        $data = array(
          'uid' => $form_state->getValue('uid'),
          'name' => $form_state->getValue('name'),
          'email' => $form_state->getValue('email'),
          'phone' => $form_state->getValue('phone'),
          'dob' => $form_state->getValue('dob')
          );
 
         //insert data to database
         \Drupal::database()->insert('student')->fields($data)->execute();
 
         // show message
         \Drupal::messenger()->addStatus('Succesfully saved');
    }
}
