<?php
/**
 * Definition of log events
 *
 * @package    mod_subheader
 * @category   log
 * @copyright  2015 Blake Kidney
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module'=>'subheader', 'action'=>'add', 'mtable'=>'subheader', 'field'=>'name'),
    array('module'=>'subheader', 'action'=>'update', 'mtable'=>'subheader', 'field'=>'name'),
);