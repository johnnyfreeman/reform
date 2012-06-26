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

namespace Reform;

use Reform\Exception\ValidationFailedException;

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
	 * Registers a ValidationRule object
	 * 
	 * @access	public
	 * @param	object
	 * @return	bool
	 */
	public function setRule($rule)
	{
		array_push($this->_validationRules, $rule);
		
		return $this;
	}

	/**
	 * To be written.
	 *
	 * @param	string	Rule name
	 * @param	mixed	Callback
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function addRule($rule, $param1 = NULL, $param2 = NULL)
	{
		// seperate parts by underscore
		$rule_parts = explode('_', $rule);

		// lowercase all and then capitalize the first charactor
		$rule_parts = array_map(
			function($part){
				return ucfirst(strtolower($part));
			}, 
			$rule_parts
		);

		$rule = implode('', $rule_parts);

		if (class_exists('Reform\\ValidationRule\\' . $rule, TRUE))
		{
			$rule = 'Reform\\ValidationRule\\' . $rule;
			
			// instantiate new rule with params
			$rule = new $rule($param1, $param2);

			// encapsulate the field inside 
			// the rule for easy access
			$rule->setField($this);

			// save this rule to this field
			$this->setRule($rule);
		}
		
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
		if (is_object($label) && is_a($label, 'Reform\\Element\\Label'))
		{
			$this->_label = $label;
		}

		return $this;
	}

	/**
	 * Get Label for this field
	 *
	 * @param	mixed	Label as object or string
	 * @return	object	Returns the current element (object) to allow method chaining
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