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
 * AlphaNumeric rule
 */
class AlphaNumeric extends ValidationRule
{
	/**
	 * Error Message
	 *
	 * @var string
	 **/
	protected $_errorMessage = 'Value contains non-alphanumeric characters';

	/**
	 * Run validation check
	 *
	 * @return	bool
	 **/
	public function run()
	{
		$val = $this->getField()->getValue();

		// don't run if field is empty
		if (empty($val)) return;

		// validate alphanumeric
		if (!ctype_alnum($val))
			throw new ValidationFailedException($this);
	}
}