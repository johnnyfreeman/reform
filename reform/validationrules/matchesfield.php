<?php

/**
 * re:form
 *
 * re:form is an object oriented approach to creating, nesting, 
 * modifying, deleting, and validating forms in the DOM.
 *
 * @package    re:form
 * @version    1.0 rc1
 * @author     Johnny Freeman
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @copyright  2011 Johnny Freeman All right reserved.
 * @link       http://johnnyfreeman.github.com/re-form
 */

namespace Reform\ValidationRules;

/**
 * MatchesField rule
 */
class MatchesField extends \Reform\ValidationRule
{
	/**
	 * =================
	 * Validation Logic
	 * =================
	 **/

	/**
	 * Class constructor
	 *
	 * @param	mixed	another field to be matched against
	 * @return	object	MatchesField
	 **/
	function __construct($matched_field)
	{
		$this->set_matched_value($matched_field);
		
		return $this;
	}
	
	/**
	 * Run validation check
	 *
	 * @return	bool
	 **/
	public function run()
	{
		$field_value = $this->get_field()->get_value();

		// validation passed if field value is either 
		// empty or if it's equal to the matched field value
		return empty($field_value) || $field_value == $this->get_matched_value();
	}

	/**
	 * ==============
	 * Error Message
	 * ==============
	 **/
	
	/**
	 * Error Message
	 *
	 * @var string
	 **/
	protected $_error_message = 'The %s field must be equal to the %s field.';
	
	/**
	 * Gets the error message above and 
	 * inserts the field name, and the 
	 * value it's intended to have.
	 *
	 * @var string
	 **/
	public function get_error_message()
	{
		return sprintf($this->_error_message, $this->get_field()->get_attribute('name'), $this->get_matched_field()->get_attribute('name'));
	}

	/**
	 * ==============
	 * Matched Field
	 * ==============
	 **/

	/**
	 * Another field for the field-to-be-validated 
	 * to be matched up against
	 *
	 * @var string
	 **/
	protected $_matched_value;

	/**
	 * Gets the matched field's value
	 *
	 * @param	mixed
	 * @return	string	_matched_field property
	 **/
	public function set_matched_value($field)
	{
		if (is_object($field))
		{
			$field = $field->get_attribute('name');
		}

		$this->_matched_value = isset($_POST[$field]) ? $_POST[$field] : NULL;
		
		return $this;
	}
	
	/**
	 * Sets the matched field's value
	 *
	 * @return	string	_matched_field property
	 **/
	public function get_matched_value()
	{
		return $this->_matched_field;
	}
}