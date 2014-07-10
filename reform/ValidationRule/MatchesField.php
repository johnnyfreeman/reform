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

use Reform\Exception\ValidationFailedException;
use Reform\Field\Field;

/**
 * MatchesField rule
 */
class MatchesField extends ValidationRule
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
	function __construct(Field $matched_field)
	{
		$this->setMatchedField($matched_field);
		
		return $this;
	}
	
	/**
	 * Run validation check
	 *
	 * @throws	ValidationFailedException
	 * @return	void
	 **/
	public function run()
	{
		if ($this->getField()->getValue() !== $this->getMatchedField()->getValue())
		{
			throw new ValidationFailedException($this);
		}
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
	protected $_errorMessage = 'The %s field must be equal to the %s field.';
	
	/**
	 * Gets the error message above and 
	 * inserts the field name, and the 
	 * value it's intended to have.
	 *
	 * @var string
	 **/
	public function getErrorMessage()
	{
		return sprintf($this->_errorMessage, $this->getField()->getAttribute('name'), $this->getMatchedField()->getAttribute('name'));
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
	protected $_matchedField;

	/**
	 * Sets the matched field's value
	 *
	 * @param	mixed
	 * @return	string	_matchedField property
	 **/
	public function setMatchedField(Field $field)
	{
		$this->_matchedField = $field;
		
		return $this;
	}
	
	/**
	 * Gets the matched field's value
	 *
	 * @return	string	_matchedField property
	 **/
	public function getMatchedField()
	{
		return $this->_matchedField;
	}
}