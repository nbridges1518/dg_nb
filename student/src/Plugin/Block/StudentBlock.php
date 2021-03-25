<?php

namespace Drupal\student\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Displays Number of Students Signed Up.
 *
 * @Block(
 *   id = "student_count_block",
 *   admin_label = @Translation("Student Count block"),
 *   category = @Translation("Custom"),
 * )
 */

class StudentBlock extends BlockBase {
      
 /**
   * {@inheritdoc}
 */
       
  public function build() {

  $query = \Drupal::database()->select('student', 't');	  
  $num_rows = $query->countQuery()->execute()->fetchField();


     return [
	'#markup' => $num_rows,        
   ];
  }
 }
