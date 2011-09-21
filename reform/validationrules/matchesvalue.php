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
 * MatchesValue rule
 */
class MatchesValue extends \Reform\ValidationRule
{
	/**
	 * =================
	 * Validation Logic
	 * =================
	 **/

	/**
	 * Class constructor
	 *
	 * @param	string	Value to be matched against
	 * @return	object	MatchesValue
	 **/
	function __construct($matched_value = '')
	{
		$this->set_matched_value($matched_value);
		
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

		// validation passed if field valie is either 
		// empty or if it's equal to the matched value
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
	protected $_error_message = 'The %s field must be equal to "%s".';
	
	/**
	 * Gets the error message above and 
	 * inserts the field name, and the 
	 * value it's intended to have.
	 *
	 * @var string
	 **/
	public function get_error_message()
	{
		return sprintf($this->_error_message, $this->get_field()->get_attribute('name'), $this->get_matched_value());
	}

	/**
	 * ==============
	 * Matched Value
	 * ==============
	 **/

	/**
	 * Some Value for the field 
	 * to be matched up against
	 *
	 * @var string
	 **/
	protected $_matched_value;

	/**
	 * Gets the value the will be used to validate the field with
	 *
	 * @param	string
	 * @return	string	_matched_value property
	 **/
	public function set_matched_value($value)
	{
		$this->_matched_value = $value;
		
		return $this;
	}
	
	/**
	 * Sets the value the will be used to validate the field with
	 *
	 * @return	string	_matched_value property
	 **/
	public function get_matched_value()
	{
		return $this->_matched_value;
	}
}