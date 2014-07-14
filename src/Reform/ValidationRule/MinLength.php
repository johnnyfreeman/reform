<?php

/**
 * re:form
 *
 * re:form is an object oriented approach to creating, nesting, 
 * modifying, deleting, and validating forms in the DOM.
 *
 * @package    re:form
 * @author     Johnny Freeman
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @copyright  2011 Johnny Freeman All right reserved.
 * @link       https://github.com/johnnyfreeman/reform
 */

namespace Reform\ValidationRule;

use Reform\ValidationRule;
use Reform\Exception\ValidationFailedException;

/**
 * MinLength rule
 */
class MinLength extends ValidationRule
{
	/**
	 * Constructor
	 *
	 * @param	string	Value to be matched against
	 * @return	object	MatchesValue
	 **/
	function __construct($len)
	{
		$this->_len = $len;
		
		return $this;
	}

	/**
	 * Error Message
	 *
	 * @var string
	 **/
	protected $_errorMessage = 'Value is too short';

	/**
	 * Run validation check
	 *
	 * @return	bool
	 **/
	public function run()
	{
		if (strlen($this->getField()->getValue()) < $this->_len)
			throw new ValidationFailedException($this);
	}
}