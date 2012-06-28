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

namespace Reform\ValidationRule;

use Reform\Exception\ValidationFailedException;

/**
 * MatchesValue rule
 */
class MatchesValue extends ValidationRule
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
		$this->setMatchedValue($matched_value);
		
		return $this;
	}
	
	/**
	 * Run validation check
	 *
	 * @return	bool
	 **/
	public function run()
	{
		if ($this->getField()->getValue() !== $this->getMatchedValue())
		{
			throw new ValidationFailedException($this->getErrorMessage());
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
	protected $_errorMessage = 'The %s field must be equal to "%s".';
	
	/**
	 * Gets the error message above and 
	 * inserts the field name, and the 
	 * value it's intended to have.
	 *
	 * @var string
	 **/
	public function getErrorMessage()
	{
		return sprintf($this->_errorMessage, $this->getField()->getAttribute('name'), $this->getMatchedValue());
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
	protected $_matchedValue;

	/**
	 * Gets the value the will be used to validate the field with
	 *
	 * @param	string
	 * @return	string	_matched_value property
	 **/
	public function setMatchedValue($value)
	{
		$this->_matchedValue = $value;
		
		return $this;
	}
	
	/**
	 * Sets the value the will be used to validate the field with
	 *
	 * @return	string	_matched_value property
	 **/
	public function getMatchedValue()
	{
		return $this->_matchedValue;
	}
}