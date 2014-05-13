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

namespace Reform\Exception;

use Exception;

/**
 * ValidationFailedException
 *
 * Generates validation errors.
 */
class ValidationFailedException extends Exception
{
	/**
	 * Error Message
	 *
	 * @var string
	 **/
	protected $message;

	/**
	 * Line Number
	 *
	 * @var int
	 **/
	protected $line;

	/**
	 * File path
	 *
	 * @var string
	 **/
	protected $file;

	/**
	 * Returns error message when ValidationFailedException object is cast as a string
	 * 
	 * @access	public
	 * @return	string
	 */
	public function __toString()
	{
		return $this->message;
	}
}