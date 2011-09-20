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

namespace Phormula\Fields;

/**
 * Element class
 **/
class TextAreaField extends \Phormula\Field {
		
	protected $_tag_name = 'textarea';
	
	protected $_attributes = array(
		'name' => ''
	);
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	public function __construct($name, $value = '', $attributes = array())
	{
		if (is_string($name))
		{
			$this->set_attribute('name', $name);

			if (!empty($value))
			{
				$this->set_value($value);
			}
			
			$this->set_attributes($attributes);
		}
		else if (is_array($name))
		{
			$this->set_attributes($name);
		}
		
		return parent::__construct();
	}
	
	/**
	 * ==============================================
	 * Methods for getting / setting textarea values
	 * ==============================================
	 **/

	/**
	 * Set field value
	 *
	 * @param	string	Value to be set
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function set_value($value)
	{
		$this->_child_elements = array($value);
		
		return $this;
	}
	
	/**
	 * Get field value
	 *
	 * @param	string	Value to be set
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function get_value()
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