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
 * Element class
 **/
abstract class Element {
	
	/**
	 * Name of the tag. Ex "input"
	 *
	 * @var string
	 **/
	protected $_tag_name;
	
	/**
	 * Array of Elements Attributes
	 * 
	 * This is also used to define the 
	 * element's attribute defaults
	 *
	 * @var array
	 **/
	protected $_attributes = array();
	
	/**
	 * Array of nested Elements (object) 
	 * or text nodes (string)
	 *
	 * @var	array
	 **/
	protected $_child_elements = array();
	
	/**
	 * Holds the immediate parent element object
	 *
	 * @var object
	 **/
	protected $_parent_element;
	
	/**
	 * Self closing flag
	 *
	 * @var string
	 **/
	protected $_self_closing_tag = FALSE;
	
	/**
	 * ==================================================
	 * Methods for working with the element's tag name
	 * ==================================================
	 **/

	 /**
	 * Get tag name
	 *
	 * @return	mixed	Attribute's value or NULL
	 **/
	public function get_tag_name()
	{
		return $this->_tag_name;
	}
	
	/**
	 * ==================================================
	 * Methods for working with the element's attributes
	 * ==================================================
	 **/
	
	/**
	 * Get Attribute
	 *
	 * @param	string	Name of attribute
	 * @return	mixed	Attribute's value or NULL
	 **/
	public function get_attribute($name)
	{
		return array_key_exists($name, $this->_attributes) ? $this->_attributes[$name] : NULL;
	}
	
	/**
	 * Alias to get_attribute(). It allows you get
	 * an element's attributes as if it were a 
	 * property of the element object, like so:
	 * 
	 * $form = new Form('process.php');
	 * $form_action_attr = $form->action;
	 *
	 * @param	string	Name of attribute
	 * @return	mixed	Attribute's value or NULL
	 **/
	public function __get($name)
	{
		return $this->get_attribute($name);
	}
	
	/**
	 * Get All Attributes
	 *
	 * @return	array	Array of attributes as a name => value pair
	 **/
	public function get_attributes()
	{
		return $this->_attributes;
	}
	
	/**
	 * Set an Attribute's Value
	 *
	 * @param	string	Name of attribute
	 * @param	string	New value
	 * @return	object	Returns the object to allow method chaining
	 **/
	public function set_attribute($name, $value)
	{
		$this->_attributes[$name] = $value;
		
		return $this;
	}
    
	/**
	 * Alias to set_attribute(). It allows you set
	 * an element's attributes as if it were a 
	 * property of the element object, like so:
	 * 
	 * $form = new Form();
	 * $form->action = 'process.php';
	 *
	 * @param	string	Name of attribute
	 * @param	string	New value
	 * @return	object	Returns the object to allow method chaining
	 **/
	public function __set($name, $value)
	{
		return $this->set_attribute($name, $value);
	}
	
	/**
	 * Remove Attribute
	 *
	 * @param	string	Name of attribute
	 * @return	object	Returns the object to allow method chaining
	 **/
	public function remove_attribute($name)
	{
		if (isset($this->_attributes[$name]))
		{
			unset($this->_attributes[$name]);
		}
		
		return $this;
	}
	
	/**
	 * Set Multiple Attributes at the same time
	 *
	 * @param	array	Name => value pairs
	 * @return	object	Returns the object to allow method chaining
	 **/
	public function set_attributes($attributes = array())
	{
		foreach ($attributes as $name => $value)
		{
			$this->set_attribute($name, $value);
		}
		
		return $this;
	}
	
	/**
	 * Attribute Existence Check
	 *
	 * @param	string	Name of attribute
	 * @return	bool	TRUE if it exists and FALSE if otherwise
	 **/
	public function attribute_exists($name)
	{
		return array_key_exists($this->get_attributes(), $name) ? TRUE : FALSE;
	}
	
	/**
	 * Convert all attributes to a string (think 
	 * of this as a __toString method for the 
	 * $_attributes property)
	 *
	 * @return	string	string of all attributes
	 **/
	public function attributes_to_string()
	{
		$attributes = array();
		
		foreach ($this->get_attributes() as $name => $value)
		{
			if (is_string($value))
			{
				$attributes[] = $name . '="' . $value . '"';
			}
		}
		
		return implode(' ', $attributes);
	}

	/**
	 * =========================================
	 * Methods for working with nested elements
	 * =========================================
	 **/
	
	/**
	 * Get nested elements
	 *
	 * @return	array	Array of elements (object) and text nodes (string)
	 **/
	public function get_children()
	{
		return $this->_child_elements;
	}
	
	/**
	 * Set Child Element
	 *
	 * @param	mixed	child element (object) or text node (string)
	 * @param	string	Whether to position the new child before or after existing children
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function set_child($element, $position = 'bottom')
	{
		// you can't nest anything inside self closing elements
		if ($this->_self_closing_tag)
		{
			throw new LogicException('You cannot add a child element to a self closing element.');
		}
		
		// where to place the child
		if ($position == 'bottom')
		{
			array_push($this->_child_elements, $element);
		}
		else if ($position == 'top')
		{
			array_unshift($this->_child_elements, $element);
		}
		
		// if child is an object, set 
		// current object as its parent
		if ($element instanceof Element)
		{
			$element->set_parent($this);
		}
		
		return $this;
	}

	/**
	 * Has nested elements
	 *
	 * @return	bool
	 **/
	public function has_children()
	{
		return count($this->_child_elements) > 0;
	}

	/**
	 * Append Child Element(s) to self
	 *
	 * @param	mixed	Element object or an array of Element objects
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function append($elements = array())
	{
		if (!is_array($elements))
		{
			$elements = array($elements);
		}
		
		$elements = array_reverse($elements, TRUE);

		foreach ($elements as $element) {
			$this->set_child($element);
		}
		
		return $this;
	}

	/**
	 * Append self to Another Element
	 *
	 * @param	object	Element object
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function append_to($element)
	{
		$element->set_child($this);

		return $this;
	}

	/**
	 * Prepend Child Element(s) to self
	 *
	 * @param	mixed	Element object or an array of Element objects
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function prepend($elements = array())
	{
		if (!is_array($elements))
		{
			$elements = array($elements);
		}
		
		$elements = array_reverse($elements, TRUE);

		foreach ($elements as $element) {
			$this->set_child($element, 'top');
		}
		
		return $this;
	}

	/**
	 * Prepend self to Another Element
	 *
	 * @param	object	Element object
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function prepend_to($element)
	{
		$element->set_child($this, 'top');

		return $this;
	}
	
	/**
	 * Set Parent Element
	 *
	 * @param	object	Parent element
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function set_parent($element)
	{
		if (!is_object($element))
		{
			throw new LogicException('You cannot set a parent element that is not of the <em>object</em> type.');
		}
		
		$this->_parent_element = $element;
		
		return $this;
	}
	
	/**
	 * Get Parent Element
	 *
	 * @return	object	Returns the object to allow method chaining
	 **/
	public function get_parent()
	{
		return $this->_parent_element;
	}
	
	/**
	 * ===========================================
	 * Method to check if element is self closing
	 * ===========================================
	 **/

	 /**
	 * Is this element self closing 
	 * e.g. <img src="pic.png" /> or <input type="text" name="" />
	 *
	 * @return	bool	Returns the object to allow method chaining
	 **/
	public function is_self_closing()
	{
		return $this->_self_closing_tag;
	}

	/**
	 * =======================================================
	 * Traversing
	 * =======================================================
	 **/
	
	/**
	 * Find Ancester element
	 *
	 * @return	mixed	
	 **/
	public function find_ancestor($attr)
	{
		if (is_string($attr))
		{
			$attr = array('id'=>$attr);
		}

		$parent = $this->get_parent();
		$parent_attr = $parent->get_attributes();

		if (!is_object($parent) || empty($parent_attr))
		{
			return FALSE;
		}

		return $this->_array_in_array($attr, $parent_attr) ? $parent : $parent->find_ancestor($attr);
	}
	
	/**
	 * Find Parent element
	 *
	 * @return	mixed	
	 **/
	public function find_parent($attr)
	{
		if (is_string($attr))
		{
			$attr = array('id' => $attr);
		}

		$parent = $this->get_parent();
		$parent_attr = $parent->get_attributes();

		if (!is_object($parent) || empty($parent_attr) || !$this->_array_in_array($attr, $parent_attr))
		{
			return FALSE;
		}

		return $parent;
	}
	
	/**
	 * Find Child element
	 *
	 * @return	mixed	
	 **/
	public function find_child($attr)
	{
		if (is_string($attr))
		{
			$attr = array('id'=>$attr);
		}

		$children = $this->get_children();

		foreach ($children as $child)
		{
			if (!is_object($child))
			{
				continue;
			}

			if ($this->_array_in_array($attr, $child->get_attributes()))
			{
				return $child;
			}
		}

		return FALSE;
	}
	
	/**
	 * Find Child element
	 *
	 * @return	mixed	
	 **/
	public function find_descendant($attr)
	{
		if (is_string($attr))
		{
			$attr = array('id' => $attr);
		}

		$children = $this->get_children();

		foreach ($children as $child)
		{
			if (!is_a($child, 'Reform\\Element'))
			{
				continue;
			}
			
			if ($this->_array_in_array($attr, $child->get_attributes()))
			{
				return $child;
			}
			else
			{
				$result = $child->find_descendant($attr);
			}

			if (is_a($result, 'Reform\\Element'))
			{
				return $result;
			}
		}

		return NULL;
			
	}

	/**
	 * Array in(side) Array
	 * 
	 * If all key->value pairs from array 1 are found 
	 * in array 2, it returns TRUE, FALSE otherwise.
	 *
	 * @return	mixed	
	 **/
	protected function _array_in_array($array1, $array2)
	{
		foreach ($array1 as $key => $value)
		{
			if (!isset($array2[$key]) || $array2[$key] !== $value)
			{
				return FALSE;
			}
		}

		return TRUE;
	}

	/**
	 * =======================================================
	 * Methods for working with the element's class attribute
	 * =======================================================
	 **/
	
	/**
	 * Add class to the class attribute. If class 
	 * attribute doesn't exist it will create it.
	 *
	 * @param	string	Class name
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function add_class($name)
	{
		if ($this->class_exists($name))
		{
			return TRUE;
		}
		
		if (is_array($existing_classes = $this->_class_string_to_array()))
		{
			array_push($existing_classes, $name);
		}
		else
		{
			$existing_classes = array($name);
		}
		
		$this->set_attribute('class', implode(' ', $existing_classes));
		
		return $this;
	}
	
	/**
	 * Remove a class if it exists in the class attribute
	 *
	 * @param	string	class name
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function remove_class($name)
	{
		$existing_classes = $this->_class_string_to_array();
		
		foreach ($existing_classes as $key => $class)
		{
			if ($name == $class)
			{
				unset($existing_classes[$key]);
			}
		}
		
		$this->set_attribute('class', implode(' ', $existing_classes));
		
		return $this;
	}
	
	/**
	 * Converts a string of space-delimited classnames to an array
	 *
	 * @return	array	classnames
	 **/
	protected function _class_string_to_array()
	{
		$classes = $this->get_attribute('class');
		
		return !empty($classes) ? explode(' ', $classes) : array();
	}
	
	/**
	 * Check for the existence of a classname within the class attribute.
	 *
	 * @param	string	class name
	 * @return	bool	true if it exists or false if otherwise
	 **/
	public function class_exists($name)
	{
		$existing_classes = explode(' ', $this->get_attribute('class'));
		
		foreach ($existing_classes as $class)
		{
			if ($name == $class)
			{
				return TRUE;
			}
		}
		
		return FALSE;
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

		if (file_exists($template))
		{
			ob_start();
			include($template);
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}
		else
		{
			ob_start();
			include(REFORM_PATH . 'templates/element.php');
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}

		
	}
}