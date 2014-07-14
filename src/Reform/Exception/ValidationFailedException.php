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

namespace Reform\Exception;

use Exception;
use Reform\ValidationRule;

/**
 * ValidationFailedException
 *
 * Generates validation errors.
 */
class ValidationFailedException extends Exception
{
	/**
	 * Overiride Exception constructor
	 * 
	 * @access	public
	 * @return	string
	 */
	public function __construct(ValidationRule $rule)
	{
		$this->rule = $rule;
		parent::__construct($rule->getErrorMessage());
	}
	
	/**
	 * Returns error message when ValidationFailedException object is cast as a string
	 * 
	 * @access	public
	 * @return	string
	 */
	public function __toString()
	{
		return $this->getMessage();
	}
}