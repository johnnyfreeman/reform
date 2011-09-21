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

namespace Reform\Elements;

/**
 * Form class
 **/
class Form extends \Reform\Element {
		
	protected $_tag_name = 'form';
	
	
	protected $_attributes = array(
			'action' => '',
			'method' => 'post'
		);
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	public function __construct($attributes)
	{
		// attributes is a string, assume action
		if (is_string($attributes))
		{
			$this->set_attribute('action', $attributes);
		}
		else if (is_array($attributes))
		{
			$this->set_attributes($attributes);
		}
		
		return $this;
	}

	/**
	 * Recursively loops through all elements in a Form (and 
	 * it's children), running any validation rules it may have.
	 *
	 * @access	public
	 * @param	mixed	(bool) NULL or (object) Element
	 * @return	void
	 **/
	public function validate($elements = NULL)
	{
		if (!empty($_POST))
		{
			// return;
		}
		
		// if no element is passed, get all children of this Form Field
		is_null($elements) AND $elements = $this->get_children();

		// loopty loop
		foreach ($elements as $element)
		{
			// if this element is a subclass of the Field object,
			// loop through it's rules and run each
			if (is_a($element, 'Reform\\Field'))
			{
				foreach ($element->get_rules() as $rule)
				{
					if (!$rule->validate())
					{
						$element->set_error($rule->get_error_message());

						$this->_error_count++;
					}
				}
			}

			// if this element is NOT a subclass of the Field object and it has children,
			// loop through this whole process with it's children
			else if ($element->has_children())
			{
				$this->validate($element);
			}
		}
	}

	/**
	 * ================================================
	 * Methods for working with ValidationRule objects
	 * ================================================
	 **/

	/**
	 * Number of ValidationError's in this form
	 *
	 * @var	int
	 **/
	protected $_error_count = 0;
	
	/**
	 * Checks if this form has any ValidationErrors
	 *
	 * @return	array	Returns an array of ValidationError objects
	 **/
	public function has_errors()
	{
		return $this->_error_count > 0 ? TRUE : FALSE;
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
	// public function __toString()
	// {
	// 	// open tag
	// 	$output = '<' . $this->_tag_name;
		
	// 	// write in attributes
	// 	if (!empty($this->_attributes))
	// 	{
	// 		$output .= ' ' . $this->_attributes_to_string();
	// 	}

	// 	$output .= '>';

	// 	$output .= '<ul>';
	
	// 	// here's that inner html we were talking about
	// 	foreach ($this->get_child_elements() as $element)
	// 	{
	// 		$output .= '<li><label>' . $element->get_attribute('name') . '</label><span>' . $element . '</span></li>';

	// 		if (is_a($element, 'Phormula\\Field') && $element->has_errors())
	// 		{
	// 			$output .= '<li>' . $element->get_error() . '</li>';
	// 		}
	// 	}

	// 	$output .= '</ul>';
		
	// 	// call her done
	// 	$output .= '</' . $this->_tag_name . '>';

	// 	return $output;
	// }
}