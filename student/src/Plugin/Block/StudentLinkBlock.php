<?php
namespace Drupal\student\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
/**
 * Displays link if student is logged in and not signed up for course.
 *
 * @Block(
 *   id = "student_link_block",
 *   admin_label = @Translation("Student link block"),
 *   category = @Translation("Custom"),
 * )
 */
class StudentLinkBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
 $internal_link ='';
 $uid = \Drupal::currentUser()->id();

 $query = \Drupal::database()->select('student', 't');
 $result =  $query->fields('t', ['uid'])
      ->condition('uid', $uid)
      ->execute()
      ->fetchField();
 dsm($result);

 if(!$result) {
  $url = Url::fromRoute('student.form');
  $internal_link = \Drupal::l(t('Sign up for Class Here!'), $url);
 }else{
 $internal_link = 'You have already signed up';
 }

  return [
   '#markup' => $internal_link,  
   ];
  }
}
