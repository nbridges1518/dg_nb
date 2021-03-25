<?php

namespace Drupal\student_command\Commands;

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
 */
class StudentCommands extends DrushCommands
{

    /**
     * Drush command that displays the given text.
     *
     * 
     * 
     * @command student_custom_commands:student
     * @aliases drush-student student
     * @usage student_custom_commands: student
     * 
     */
    public function student()
    {
        $query = \Drupal::database()->select('student', 't');
        $result =  $query->fields('t')        
            ->execute()
            ->fetchAllKeyed();
           
        
        $this->output()->writeln($result);
    }


}
