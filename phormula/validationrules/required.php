<?php

/**
 * Phormula
 *
 * Phormula is an object oriented approach to creating, nesting, 
 * modifying, deleting, and validating form field elements in the DOM.
 *
 * @package    Phormula
 * @version    1.0 rc1
 * @author     Johnny Freeman
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @copyright  2011 Johnny Freeman
 * @link       http://code.johnnyfreeman.us/phormula
 */

namespace Phormula\ValidationRules;

/**
 * Required rule
 */
class Required extends \Phormula\ValidationRule
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
		$field_value = $this->get_field()->get_value();

		return empty($field_value) ? FALSE : TRUE;
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
	protected $_error_message = 'This field is required.';
}