<?php
/**
 * Redirect the user to the appropriate submission related page
 *
 * @package   mod_subheader
 * @category  grade
 * @copyright 2015 Blake Kidney
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//load Moodle
require_once('../../config.php');

//get the course module id from the url
$id = required_param('id', PARAM_INT);

/*
//item number may be != 0 for activities that allow more than one grade per user.
$itemnumber = optional_param('itemnumber', 0, PARAM_INT);

//get the optional graded user id from the url
$userid = optional_param('userid', 0, PARAM_INT); 
*/

//redirect to the view page
redirect('view.php?id='.$id);
