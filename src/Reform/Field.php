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

namespace Reform;

use Reform\Element\Label;
use Reform\Exception\ValidationFailedException;
use Reform\ValidationRule;

/**
 * Field class
 **/
abstract class Field extends Element
{
	/**
	 * ================================================
	 * Methods for working with ValidationRule objects
	 * ================================================
	 **/
	
	/**
	 * Array of ValidationRule Objects
	 *
	 * @var string
	 **/
	protected $_validationRules = array();
	
	/**
	 * Returns an array of all registered ValidationRule objects
	 * 
	 * @access	public
	 * @return	array
	 */
	public function getRules()
	{
		return $this->_validationRules;
	}

	/**
	 * Binds a ValidationRule to this field
	 *
	 * @param	Reform\ValidationRule
	 * @return	Reform\Field\Field
	 **/
	public function addRule(ValidationRule $rule)
	{
		array_push($this->_validationRules, $rule);
		$rule->setField($this);
		
		return $this;
	}


	/**
	 * ===========================================
	 * Methods for working with the field's label
	 * ===========================================
	 **/

	/**
	 * Label object
	 *
	 * @var object
	 **/
	protected $_label;
	
	/**
	 * Set Label for this field
	 *
	 * @param	mixed	Label as object or string
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function setLabel($label)
	{
		if (is_string($label))
		{
			$this->_label = new Label($label);
		}
		if (is_object($label) && $label instanceof Label)
		{
			$this->_label = $label;
		}

		return $this;
	}

	/**
	 * Get Label for this field
	 *
	 * @return	Reform\Element\Label
	 **/
	public function getLabel()
	{
		return $this->_label;
	}

	/**
	 * ===========================================
	 * Methods for working with errors
	 * ===========================================
	 **/

	/**
	 * Array of ValidationFailedException objects
	 * pertaining to this field only
	 *
	 * @var string
	 **/
	protected $_validationErrors = array();
	
	/**
	 * Set ValidationFailedException for this field
	 *
	 * @param	mixed	ValidationFailedException as object or string
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function setError(ValidationFailedException $error)
	{
		array_push($this->_validationErrors, $error);
		
		return $this;
	}
	
	/**
	 * Get ValidationFailedException for this field
	 *
	 * @return	array	Returns an array of ValidationFailedException objects
	 **/
	public function getErrors()
	{
		return $this->_validationErrors;
	}
	
	/**
	 * Get first ValidationFailedException for this field
	 *
	 * @return	object	Returns an array of ValidationFailedException objects
	 **/
	public function getError()
	{
		return isset($this->_validationErrors[0]) ? $this->_validationErrors[0] : NULL;
	}

	/**
	 * Check if this field has any errors
	 *
	 * @return	array	Returns an array of ValidationFailedException objects
	 **/
	public function hasErrors()
	{
		return count($this->_validationErrors) > 0 ? TRUE : FALSE;
	}

	/**
	 * Has the validation already been run?
	 *
	 * @var	bool
	 **/
	protected $_validationRan = FALSE;

	/**
	 * Run all validators
	 *
	 * @return	Reform\Field\Field
	 **/
	public function runValidation()
	{
		foreach ($this->getRules() as $rule)
		{
			try {
				$rule->run();
			}
			catch (ValidationFailedException $e)
			{
				$this->setError($e);
			}
		}

		$this->_validationRan = TRUE;

		return $this;
	}
	
	/**
	 * Checks if this form has any ValidationFailedExceptions
	 *
	 * @return	bool
	 **/
	public function isValid()
	{
		if (!$this->_validationRan)
		{
			$this->runValidation();
		}

		return count($this->getErrors()) === 0;
	}


	/**
	 * ===========================================
	 * Methods for getting / setting field values
	 * ===========================================
	 **/

	/**
	 * Set field value
	 *
	 * @param	string	Value to be set
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function setValue($value)
	{
		return $this->setAttribute('value', $value);
	}
	
	/**
	 * Get field value
	 *
	 * @param	string	Value to be set
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function getValue()
	{
		return $this->getAttribute('value');
	}

	/**
	 * ======================================
	 * Converting the element(s) to a string
	 * ======================================
	 **/
	
	/**
	 * Convert the element object and all of it's children to a string.
	 *
	 * @return	string	element as html
	 **/
	public function __toString()
	{	
		$class = get_class($this);

		// strip namepaces
		$class = substr($class, strrpos($class, "\\") + 1);
		$template = REFORM_PATH . 'templates/' . strtolower($class) . '.php';

		ob_start();

		if (file_exists($template))
		{
			include($template);
		}
		else
		{
			include(REFORM_PATH . 'templates/field.php');
		}

		$buffer = ob_get_contents();
		@ob_end_clean();
		return $buffer;
	}
}