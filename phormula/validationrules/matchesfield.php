<?php

/**
 * Phormula
 *
 * Phormula is an object oriented approach to creating, nesting, 
 * modifying, deleting, and validating form field elements in the DOM.
 *
 * @package    Phormula
 * @version    1.0 rc1
 * @author     Johnny Freeman
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @copyright  2011 Johnny Freeman
 * @link       http://code.johnnyfreeman.us/phormula
 */

namespace Phormula\ValidationRules;

/**
 * MatchesField rule
 */
class MatchesField extends \Phormula\ValidationRule
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
		$this->set_matched_value($matched_field->get_value());
		
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
		$matched_field_value = $this->get_matched_field()->get_value();

		// validation passed if field value is either 
		// empty or if it's equal to the matched field value
		return empty($field_value) || $field_value == $matched_field_value;
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
	protected $_error_message = 'The %s field must be the same as the %s field.';
	
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
	protected $_matched_field;

	/**
	 * Gets the matched field object
	 *
	 * @param	string
	 * @return	string	_matched_field property
	 **/
	public function set_matched_field(Field $field)
	{
		$this->_matched_field = $field;
		
		return $this;
	}
	
	/**
	 * Sets the matched field
	 *
	 * @return	string	_matched_field property
	 **/
	public function get_matched_field()
	{
		return $this->_matched_field;
	}
}