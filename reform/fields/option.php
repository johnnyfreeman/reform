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

namespace Reform\Fields;

/**
 * Option class
 **/
class Option extends \Reform\Field {
	
	protected $_tag_name = 'option';
	
	protected $_attributes = array();
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	/**
	 * Constructor
	 *
	 * @param	string	option's inner text
	 * @param	mixed	array of attributes or just the value (as a string)
	 * @return	void	
	 **/
	public function __construct($label, $attributes = array())
	{
		$this->set_child($label);

		// attributes is a string
		if (is_string($attributes))
		{
			// assume value attribute
			$attributes = array('value', $attributes);
		}

		$this->set_attributes($attributes);
		
		// overwrite default value with value from POST array
		// if (!empty($_POST) && isset($_POST[$this->get_attribute('name')]))
		// {
		// 	$this->set_value($_POST[$this->get_attribute('name')]);
		// }
	}
	
	/**
	 * ==============================================
	 * Methods for getting / setting textarea values
	 * ==============================================
	 **/
	
	// function setValue() inherited from \Reform\Field
	
	/**
	 * Get field value
	 *
	 * @param	string	Value to be set
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function get_value()
	{
		if ($this->attribute_exists('value'))
		{
			return $this->get_attribute('value');
		}
		
		// use nested text
		else
		{
			$output = '';

			foreach ($this->get_children as $child)
			{
				$output .= $child;
			}

			return $output;
		}
	}
}