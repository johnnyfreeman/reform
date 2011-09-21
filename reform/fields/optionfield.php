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
 * Element class
 **/
class OptionField extends \Reform\Field {
	
	protected $_tag_name = 'option';
	
	
	protected $_attributes = array();
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	public function __construct($label, $value = NULL, $attributes = array())
	{
		// attributes is a string
		if (is_string($label))
		{
			$this->set_child_element($label);
			
			if (!is_null($value))
			{
				$this->set_attribute('value', $value);
			}
			
			$this->set_attributes($attributes);
		}
		else if (is_array($label))
		{
			$this->set_attributes($label);
		}
		
		return parent::__construct();
	}
	
	/**
	 * ==============================================
	 * Methods for getting / setting textarea values
	 * ==============================================
	 **/
	
	// function setValue() inherited from \Phormula\Field
	
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

			if (is_array($this->_child_elements))
			{
				foreach ($this->_child_elements as $child)
				{
					$output .= (string) $child;
				}
			}
			else
			{
				$output .= (string) $this->_child_elements;
			}

			return $output;
		}
	}
}