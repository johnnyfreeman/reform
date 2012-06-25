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

namespace Reform;

/**
 * Validation Rule
 *
 * 
 */
abstract class ValidationRule
{
	/**
	 * Once a rule is run the result is stored here
	 *
	 * @var bool
	 **/
	protected $_run_result;

	/**
	 * The Run method is called by the Validation object upon validating all fields and should contain the logic for rule. Also, it should return TRUE or FALSE
	 *
	 * @access	public
	 **/
	public abstract function run(); // to be implimented in sub classes

	/**
	 * The Run method is called by the Validation object upon validating all fields and should contain the logic for rule. Also, it should return TRUE or FALSE
	 *
	 * @access	public
	 **/
	public function validate()
	{
		if (is_null($this->_run_result))
		{
			$this->_run_result = $this->run();
		}

		return $this->_run_result;
	}

	/**
	 * ============================
	 * Error Message for this rule
	 * ============================
	 **/

	/**
	 * Generic error message. Should be overwritten in sub classes.
	 *
	 * @var string
	 **/
	protected $_error_message = 'This field failed validation.';
	
	/**
	 * Returns formatted error message with the field's name inserted into the _error_message property.
	 *
	 * @access	public
	 **/
	public function get_error_message()
	{
		return $this->_error_message;
	}
	
	/**
	 * Allows you to set a formatted error message.
	 *
	 * @access	public
	 **/
	public function set_error_message($message)
	{
		$this->_error_message = $message;

		return $this;
	}

	/**
	 * ============================================
	 * Field this rule is associated with
	 * ============================================
	 **/

	/**
	 * Field object being validated
	 *
	 * @var Field instance
	 **/
	protected $_field;

	/**
	 * Attaches the field-to-be-validated to the subclassed rule
	 * 
	 * @access	public
	 * @param	object	Field
	 * @return	object	ValidationRule
	 */
	public function set_field(Field $field)
	{
		$this->_field = $field;
		
		return $this;
	}
	
	/**
	 * Gets the instance of the Field-to-be-validated
	 * 
	 * @access public
	 * @param 	
	 * @return Field instance
	 */
	public function get_field()
	{
		return $this->_field;
	}
}