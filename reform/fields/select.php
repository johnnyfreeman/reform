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
 * Select class
 **/
class Select extends \Reform\Field {
		
	protected $_tag_name = 'select';
	
	
	protected $_attributes = array(
			'name' => ''
		);
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	public function __construct($attributes = array(), $options = array())
	{
		// attributes is a string
		if (is_string($attributes))
		{
			// assume name attribute
			$attributes = array('name', $attributes);
		}
		
		$this->set_attributes($attributes);

		foreach ($options as $label => $option_attributes)
		{
			if (is_a($attributes, 'Reform\\Field\\Option'))
			{
				$this->set_child($option_attributes);
			}
			else
			{
				$this->set_child(new Option($label, $option_attributes));
			}
		}
		
		// overwrite default value with value from POST array
		// if (!empty($_POST) && isset($_POST[$this->get_attribute('name')]))
		// {
		// 	$this->set_value($_POST[$this->get_attribute('name')]);
		// }
	}


	
	/**
	 * ==============================================
	 * Methods for getting / setting select values
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
		// $this->_child_elements = array($value);
		
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
		// all children should be instances of the OptionField
		foreach ($this->get_children() as $option)
		{
			// if it is selected, get it's value
			if ($option->get_attribute('selected') === 'selected')
			{
				return $option->get_value();
			}
		}
	}
}