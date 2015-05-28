<?php
/**
 * Defines backup_subheader_activity_task class
 *
 * @package   mod_subheader
 * @category  backup
 * @copyright 2015 Blake Kidney
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/mod/subheader/backup/moodle2/backup_subheader_stepslib.php');

/**
 * Provides the steps to perform one complete backup of the subheader instance
 *
 * @package   mod_subheader
 * @category  backup
 * @copyright 2015 Blake Kidney
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_subheader_activity_task extends backup_activity_task {

    /**
     * No specific settings for this activity
     */
    protected function define_my_settings() {
    }

    /**
     * Defines a backup step to store the instance data in the subheader.xml file
     */
    protected function define_my_steps() {
        $this->add_step(new backup_subheader_activity_structure_step('subheader_structure', 'subheader.xml'));
    }

    /**
     * Encodes URLs to the index.php and view.php scripts
     *
     * @param string $content some HTML text that eventually contains URLs to the activity instance scripts
     * @return string the content with the URLs encoded
     */
    static public function encode_content_links($content) {
        return $content;
    }
}
