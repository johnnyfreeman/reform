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
	protected $_validation_rules = array();
	
	/**
	 * Returns an array of all registered ValidationRule objects
	 * 
	 * @access	public
	 * @return	array
	 */
	public function get_rules()
	{
		return $this->_validation_rules;
	}
	
	/**
	 * Registers a ValidationRule object
	 * 
	 * @access	public
	 * @param	object
	 * @return	bool
	 */
	public function set_rule($rule)
	{
		array_push($this->_validation_rules, $rule);
		
		return $this;
	}

	/**
	 * To be written.
	 *
	 * @param	string	Rule name
	 * @param	mixed	Callback
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function add_rule($rule, $param1 = NULL, $param2 = NULL)
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
			$rule->set_field($this);

			// save this rule to this field
			$this->set_rule($rule);
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
	public function set_label($label)
	{
		if (is_string($label))
		{
			$this->_label = new \Reform\Elements\Label($label);
		}
		if (is_object($label))
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
	public function get_label()
	{
		return $this->_label;
	}

	/**
	 * ===========================================
	 * Methods for working with errors
	 * ===========================================
	 **/

	/**
	 * Array of ValidationError objects
	 * pertaining to this field only
	 *
	 * @var string
	 **/
	protected $_validation_errors = array();
	
	/**
	 * Set ValidationError for this field
	 *
	 * @param	mixed	ValidationError as object or string
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function set_error(ValidationException $error)
	{
		array_push($this->_validation_errors, $error);
		
		return $this;
	}
	
	/**
	 * Get ValidationErrors for this field
	 *
	 * @return	array	Returns an array of ValidationError objects
	 **/
	public function get_errors()
	{
		return $this->_validation_errors;
	}
	
	/**
	 * Get first ValidationError for this field
	 *
	 * @return	object	Returns an array of ValidationError objects
	 **/
	public function get_error()
	{
		return isset($this->_validation_errors[0]) ? $this->_validation_errors[0] : NULL;
	}

	/**
	 * Check if this field has any errors
	 *
	 * @return	array	Returns an array of ValidationError objects
	 **/
	public function has_errors()
	{
		return count($this->_validation_errors) > 0 ? TRUE : FALSE;
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
	public function set_value($value)
	{
		return $this->set_attribute('value', $value);
	}
	
	/**
	 * Get field value
	 *
	 * @param	string	Value to be set
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function get_value()
	{
		return $this->get_attribute('value');
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