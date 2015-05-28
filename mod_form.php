<?php

/**
 * The main subheader configuration form
 *
 * It uses the standard core Moodle formslib. For more info about them, please
 * visit: http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * @package    mod_subheader
 * @copyright  2015 Blake Kidney
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Module instance settings form
 *
 * @package    mod_subheader
 * @copyright  2015 Blake Kidney
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_subheader_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
	 * @see: https://docs.moodle.org/dev/lib/formslib.php_Form_Definition
     */
    public function definition() {

        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are showed.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field.
        $mform->addElement(
			'text',										//type of element 
			'name', 									//name of the element
			get_string('subheadername', 'subheader'), 	//label
			array('size' => '64')						//html attributes
		);
        $mform->setType('name', PARAM_TEXT);
        /*
		 * $mform->addRule($element, $message, $type, $format, $validation, $reset, $force)
		 * @param    string     $element       Form element name
		 * @param    string     $message       Message to display for invalid data
		 * @param    string     $type          Rule type, use getRegisteredRules() to get types
		 * @param    string     $format        (optional)Required for extra rule data
		 * @param    string     $validation    (optional)Where to perform validation: "server", "client"
		 * @param    boolean    $reset         Client-side validation: reset the form element to its original value if there is an error?
		 * @param    boolean    $force         Force the rule to be applied, even if the target form element does not exist
		*/
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        
		/**
		 * @param 	$elementname 	The name of the form element to add the help button for
		 * @param 	$identifier 	The identifier for the help string and its title (see below)
		 * @param 	$component 		The component name to look for the help string in
		 */
		//$mform->addHelpButton('name', 'subheadername', 'subheader');

        // Add standard elements, common to all modules.
        $this->standard_coursemodule_elements();

        // Add standard buttons, common to all modules.
        $this->add_action_buttons();
    }
}
