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
 * @return   /custom/student/src/Commands/StudentCommands.php
 */

namespace Drupal\student\Commands;

use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 *
 * @category Student
 * @package  Student
 * @author   Neil Bridges <neil@discoverygarden.com>
 * @link     Student 
 * @license  student  
 * @return   /custom/student/src/Commands/StudentCommands.php      
 */

class StudentCommands extends DrushCommands
{

    /**
     * Drush command that displays the given text.
     *
     * @command  student_custom_commands:student
     * @aliases  drush-student student
     * @usage    student_custom_commands: student
     * @return   /custom/student/src/Commands/StudentCommands.php
     * @link
     * @package 
     * @author
     * @license   
     * @category      
     */
    public function student()
    {
        $query = \Drupal::database()->select('student', 't');
        $result =  $query->fields('t')        
            ->execute()
            ->fetchAssoc();
           
        
        $this->output()->writeln($result);
    }
}

