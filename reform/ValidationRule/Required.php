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
 * Required rule
 */
class Required extends ValidationRule
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
		$field_value = $this->getField()->getValue();

		if (empty($field_value))
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
	protected $_errorMessage = 'This field is required.';
}