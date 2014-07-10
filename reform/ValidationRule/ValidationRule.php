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
 * @link       https://github.com/johnnyfreeman/reform
 */

namespace Reform\ValidationRule;

use Reform\Field\Field;
use Reform\Exception\ValidationFailedException;

/**
 * Validation Rule
 *
 * 
 */
abstract class ValidationRule
{
	/**
	 * The Run method is called by the Validation object upon validating all fields and should contain the logic for rule. Also, it should return TRUE or FALSE
	 *
	 * @access	public
	 * @throws	ValidationFailedException
	 * @return 	void
	 **/
	public abstract function run(); // to be implimented in sub classes

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
	protected $_errorMessage = 'Field failed validation';
	
	/**
	 * Returns formatted error message with the field's name inserted into the _error_message property.
	 *
	 * @access	public
	 * @return ValidationFailedException
	 **/
	public function getErrorMessage()
	{
		return $this->_errorMessage;
	}
	
	/**
	 * Allows you to set a formatted error message.
	 *
	 * @access	public
	 **/
	public function setErrorMessage($message)
	{
		$this->_errorMessage = $message;

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
	public function setField(Field $field)
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
	public function getField()
	{
		return $this->_field;
	}
}