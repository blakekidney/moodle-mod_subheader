<?php
/**
 * Subheader module upgrade.
 *
 * @package    mod_subheader
 * @copyright  2015 Blake Kidney
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Execute subheader upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_subheader_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.    

    return true;
}
