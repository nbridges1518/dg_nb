<?php

 /**
  * Student Block
  * php version 7.2.24
  * 
  * @category Student
  * @package  Student
  * @author   Neil Bridges <neil@discoverygarden.com>
  * @link     Student 
  * @license  student  
  * @return   /custom/student/src/Commands/StudentCommands.php      
  */

namespace Drupal\student\Plugin\Block;

use Drupal\Core\Url;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContextAwarePluginAssignmentTrait;


/**
 * Provides a Student Block
 *
 * @Block(
 *   id = "student_block",
 *   admin_label = @Translation("Student Block"),
 * )
 * @category Student
 * @package  Student
 * @author   Neil Bridges <neil@discoverygarden.com>
 * @link     Student 
 * @license  student
 * @var      Drupal\student\Plugin\Block  
 * @return   /custom/student/src/Block/StudentBock.php      
 */

class StudentBlock extends BlockBase implements ContainerFactoryPluginInterface {
   
 protected $account;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container    Student
     * @param array  Student                                            $configuration     Student
     * @param string Student                                            $plugin_id         Student 
     * @param mixed  Student                                            $plugin_definition Student
     * @return static
     */
 public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
     return new static(
          $configuration,
          $plugin_id,
          $plugin_definition,
          $container->get('current_user')
  );
 }

    /**
     * Constructor Description 
     *
     * @param array  Student                             $configuration     Student
     * @param string Student                             $plugin_id         Student 
     * @param mixed  Student                             $plugin_definition Student
     * @param \Drupal\Core\Session\AccountProxyInterface $account           Student
     */
 public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxyInterface $account) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->account = $account;
 }

    /** 
     * Displays students signed up for class
     * 
     * @category Student
     * @package  Student
     * @author   Neil Bridges <neil@discoverygarden.com>
     * @link     Student 
     * @license  student  
     * @return   /custom/student/src/Commands/StudentCommands.php      
     */
 public function build() {

     $build = [];
     $uid = $this->account->id();
  
     $query_count = \Drupal::database()->select('student', 't');
     $num_rows = $query_count->countQuery()->execute()->fetchField();
  
     $internal_link ='';
     $query = \Drupal::database()->select('student', 't');
          $result =  $query->fields('t', ['uid'])
              ->condition('uid', $uid)
              ->execute()
              ->fetchField();
  
     if (!$result) {
          $url = Url::fromRoute('student.form');
          $internal_link = \Drupal::l(t('Sign up for Class Here!'), $url);
     } else {
          $internal_link = t('You have already signed up');
     }
     $build['#cache']['max-age'] = 0;
     $build['student_block']['#markup'] = 'Number of Students: '.$num_rows.' '.$internal_link;
 
 return $build;
  }
}




