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
 * Matches rule
 */
class Matches extends ValidationRule
{
	/**
	 * Constructor
	 *
	 * @param	string	Value to be matched against
	 * @return	object	MatchesValue
	 **/
	function __construct($match)
	{
		$this->_match = $match;
		
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
			throw new ValidationFailedException($this);
		}
	}
	
	/**
	 * Error Message
	 *
	 * @var string
	 **/
	protected $_errorMessage = 'Value doesn\'t match `%s`';
	
	/**
	 * Gets the error message above and 
	 * inserts the field name, and the 
	 * value it's intended to have.
	 *
	 * @var string
	 **/
	public function getErrorMessage()
	{
		return sprintf($this->_errorMessage, $this->getMatchedValue());
	}
	
	/**
	 * Gets the value the will be used 
	 * to validate the field with
	 *
	 * @var string
	 **/
	public function getMatchedValue()
	{
		return $this->_match instanceof Field ? $this->_match->getAttribute('name') : $this->_match;
	}
}