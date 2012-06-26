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
	protected $_tagName;
	
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
	protected $_childElements = array();
	
	/**
	 * Holds the immediate parent element object
	 *
	 * @var object
	 **/
	protected $_parentElement;
	
	/**
	 * Self closing flag
	 *
	 * @var string
	 **/
	protected $_selfClosingTag = FALSE;
	
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
	public function getTagName()
	{
		return $this->_tagName;
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
	public function getAttribute($name)
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
		return $this->getAttribute($name);
	}
	
	/**
	 * Get All Attributes
	 *
	 * @return	array	Array of attributes as a name => value pair
	 **/
	public function getAttributes()
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
	public function setAttribute($name, $value)
	{
		$this->_attributes[$name] = $value;
		
		return $this;
	}
    
	/**
	 * Alias to setAttribute(). It allows you set
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
		return $this->setAttribute($name, $value);
	}
	
	/**
	 * Remove Attribute
	 *
	 * @param	string	Name of attribute
	 * @return	object	Returns the object to allow method chaining
	 **/
	public function removeAttribute($name)
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
	public function setAttributes($attributes = array())
	{
		foreach ($attributes as $name => $value)
		{
			$this->setAttribute($name, $value);
		}
		
		return $this;
	}
	
	/**
	 * Attribute Existence Check
	 *
	 * @param	string	Name of attribute
	 * @return	bool	TRUE if it exists and FALSE if otherwise
	 **/
	public function hasAttribute($name)
	{
		return array_key_exists($name, $this->getAttributes()) ? TRUE : FALSE;
	}
	
	/**
	 * Convert all attributes to a string (think 
	 * of this as a __toString method for the 
	 * $_attributes property)
	 *
	 * @return	string	string of all attributes
	 **/
	public function attributesToString()
	{
		$attributes = array();
		
		foreach ($this->getAttributes() as $name => $value)
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
	public function getChildren()
	{
		return $this->_childElements;
	}
	
	/**
	 * Set Child Element
	 *
	 * @param	mixed	child element (object) or text node (string)
	 * @param	string	Whether to position the new child before or after existing children
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function setChild($element, $position = 'bottom')
	{
		// you can't nest anything inside self closing elements
		if ($this->_selfClosingTag)
		{
			throw new LogicException('You cannot add a child element to a self closing element.');
		}
		
		// where to place the child
		if ($position == 'bottom')
		{
			array_push($this->_childElements, $element);
		}
		else if ($position == 'top')
		{
			array_unshift($this->_childElements, $element);
		}
		
		// if child is an object, set 
		// current object as its parent
		if ($element instanceof Element)
		{
			$element->setParent($this);
		}
		
		return $this;
	}

	/**
	 * Has nested elements
	 *
	 * @return	bool
	 **/
	public function hasChildren()
	{
		return count($this->_childElements) > 0;
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
			$this->setChild($element);
		}
		
		return $this;
	}

	/**
	 * Append self to Another Element
	 *
	 * @param	object	Element object
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function appendTo($element)
	{
		$element->setChild($this);

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
			$this->setChild($element, 'top');
		}
		
		return $this;
	}

	/**
	 * Prepend self to Another Element
	 *
	 * @param	object	Element object
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function prependTo($element)
	{
		$element->setChild($this, 'top');

		return $this;
	}
	
	/**
	 * Set Parent Element
	 *
	 * @param	object	Parent element
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function setParent(Element $element)
	{
		$this->_parentElement = $element;
		
		return $this;
	}
	
	/**
	 * Get Parent Element
	 *
	 * @return	object	Returns the object to allow method chaining
	 **/
	public function getParent()
	{
		return $this->_parentElement;
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
	public function isSelfClosing()
	{
		return $this->_selfClosingTag;
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
	public function findAncestor($attr)
	{
		if (is_string($attr))
		{
			$attr = array('id'=>$attr);
		}

		$parent = $this->getParent();
		$parent_attr = $parent->getAttributes();

		if (!is_object($parent) || empty($parent_attr))
		{
			return FALSE;
		}

		return $this->_arrayInArray($attr, $parent_attr) ? $parent : $parent->findAncestor($attr);
	}
	
	/**
	 * Find Parent element
	 *
	 * @return	mixed	
	 **/
	public function findParent($attr)
	{
		if (is_string($attr))
		{
			$attr = array('id' => $attr);
		}

		$parent = $this->getParent();
		$parent_attr = $parent->getAttributes();

		if (!is_object($parent) || empty($parent_attr) || !$this->_arrayInArray($attr, $parent_attr))
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
	public function findChild($attr)
	{
		if (is_string($attr))
		{
			$attr = array('id'=>$attr);
		}

		$children = $this->getChildren();

		foreach ($children as $child)
		{
			if (!is_object($child))
			{
				continue;
			}

			if ($this->_arrayInArray($attr, $child->getAttributes()))
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
	public function findDescendant($attr)
	{
		if (is_string($attr))
		{
			$attr = array('id' => $attr);
		}

		$children = $this->getChildren();

		foreach ($children as $child)
		{
			if (!is_a($child, 'Reform\\Element'))
			{
				continue;
			}
			
			if ($this->_arrayInArray($attr, $child->getAttributes()))
			{
				return $child;
			}
			else
			{
				$result = $child->findDescendant($attr);
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
	protected function _arrayInArray($array1, $array2)
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
	public function addClass($name)
	{
		if ($this->classExists($name))
		{
			return TRUE;
		}
		
		if (is_array($existing_classes = $this->_classStringToArray()))
		{
			array_push($existing_classes, $name);
		}
		else
		{
			$existing_classes = array($name);
		}
		
		$this->setAttribute('class', implode(' ', $existing_classes));
		
		return $this;
	}
	
	/**
	 * Remove a class if it exists in the class attribute
	 *
	 * @param	string	class name
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function removeClass($name)
	{
		$existing_classes = $this->_classStringToArray();
		
		foreach ($existing_classes as $key => $class)
		{
			if ($name == $class)
			{
				unset($existing_classes[$key]);
			}
		}
		
		$this->setAttribute('class', implode(' ', $existing_classes));
		
		return $this;
	}
	
	/**
	 * Converts a string of space-delimited classnames to an array
	 *
	 * @return	array	classnames
	 **/
	protected function _classStringToArray()
	{
		$classes = $this->getAttribute('class');
		
		return !empty($classes) ? explode(' ', $classes) : array();
	}
	
	/**
	 * Check for the existence of a classname within the class attribute.
	 *
	 * @param	string	class name
	 * @return	bool	true if it exists or false if otherwise
	 **/
	public function classExists($name)
	{
		$existing_classes = explode(' ', $this->getAttribute('class'));
		
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