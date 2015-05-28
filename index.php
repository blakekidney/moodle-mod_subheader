<?php
/**
 * Module home page 
 *
 * @package    mod_subheader
 * @copyright  2015 Blake Kidney
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


//load Moodle
require_once('../../config.php');
//load the module library
require_once('lib.php');

//get the id for the course from the url
$id = required_param('id', PARAM_INT);   

//redirect to the course page and disable this page
//redirect($CFG->wwwroot.'/course/view.php?id='.$id);

//obtain the database record for the course
$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

//read only access 
require_course_login($course);

//trigger an event showing this module has been viewed
$params = array(
    'context' => context_course::instance($course->id)
);
$event = \mod_subheader\event\course_module_instance_list_viewed::create($params);
$event->add_record_snapshot('course', $course);
$event->trigger();

//pull the language strings for the module
$strmodname      = get_string('modulename', 'mod_subheader');
$strmodnames     = get_string('modulenameplural', 'mod_subheader');
$strname         = get_string('name');
$strintro        = get_string('moduleintro');
$strlastmodified = get_string('lastmodified');

//setup the options for the page
//https://docs.moodle.org/dev/Page_API

//set the page theme layout
$PAGE->set_pagelayout('incourse');
//set the url for this page
$PAGE->set_url('/mod/subheader/index.php', array('id' => $id));
//set the <title> of the page
$PAGE->set_title($course->shortname.': '.$strmodnames);
//set the heading for the page
$PAGE->set_heading($course->fullname);

//tell the navbar to ignore the active page and add our module name 
//https://docs.moodle.org/dev/Navigation_API#Navbar
$PAGE->navbar->add($strmodnames);

//display the header
echo $OUTPUT->header();
//display the heading
echo $OUTPUT->heading($strname);

//Get an array of all the active instances of the module in the course
if(!$newmodules = get_all_instances_in_course('subheader', $course)) {
    //if there are none, then display a message indicating this
	//@param #1: message to display
	//@param @2: link to use for the continue button
	notice(get_string('nonewmodules', 'subheader'), new moodle_url('/course/view.php', array('id' => $course->id)));
}

//get a boolean indicating whether the course uses sections or not
$usesections = course_format_uses_sections($course->format);

//create a new html table
$table = new html_table();
//add the class to the table
$table->attributes['class'] = 'generaltable mod_index';

//modify the table based upon whether sections are being used or not
if($usesections) {
	//if we are using sections...
	//obtain the section name 
    $strsectionname = get_string('sectionname', 'format_'.$course->format);
	//set the table header row along with alignment
    $table->head  = array($strsectionname, $strname);
    $table->align = array('left', 'left');
} else {
	//set the table header row along with alignment
    $table->head  = array($strname);
    $table->align = array('left');
}

//get the info about all the modules in the course
$modinfo = get_fast_modinfo($course);
//setup a variable to find when a section changes
$currentsection = '';
//iterate each of the subheader modules
foreach($modinfo->instances['subheader'] as $cm) {
    //setup an array to save the table row data
	$row = array();    
	//if we are using sections, we need to pull the name of the section
	if($usesections) {
        //if the section has changed
		if($cm->sectionnum !== $currentsection) {
            //if we have a section number, add the section name to the row
			if($cm->sectionnum) {
                $row[] = get_section_name($course, $cm->sectionnum);
            }
			//if this is not the first row, then add a table divider
            if($currentsection !== '') {
                $table->data[] = 'hr';
            }
			//set the current section to the section number
            $currentsection = $cm->sectionnum;
        }
    }
	
	//dim the row if the module is not visible
    $class = $cm->visible ? null : array('class' => 'dimmed');
	
	//add to the row the name of module as a link to the module
    /*
	$row[] = html_writer::link(new moodle_url('view.php', array('id' => $cm->id)),
                $cm->get_formatted_name(), $class);
	*/
	$row[] = $cm->get_formatted_name();
	
	//add the row to the table
    $table->data[] = $row;
}

//display the table
echo html_writer::table($table);

//display the footer
echo $OUTPUT->footer();

