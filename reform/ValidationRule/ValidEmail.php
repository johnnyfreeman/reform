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

/**
 * ValidEmail rule
 */
class ValidEmail extends ValidationRule
{
	/**
	 * =================
	 * Validation Logic
	 * =================
	 **/
	
	/**
	 * Run validation check
	 *
	 * @return	bool
	 **/
	public function run()
	{
		if (!filter_var($this->getField()->getValue(), FILTER_VALIDATE_EMAIL))
		{
			throw new ValidationFailedException($this);
		}
	}
	
	/**
	 * Error Message
	 *
	 * @var string
	 **/
	protected $_errorMessage = 'Email not valid.';
}