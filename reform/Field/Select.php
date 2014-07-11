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
 * @link       https://github.com/johnnyfreeman/reform
 */

namespace Reform\Field;

use Reform\Field\Option;

/**
 * Select class
 **/
class Select extends Field {
		
	protected $_tagName = 'select';
	
	
	protected $_attributes = array(
			'name' => ''
		);
	
	protected $_childElements = array();
	
	protected $_parentElement;
	
	protected $_selfClosingTag = FALSE;
	
	public function __construct($attributes = array(), Array $options = array())
	{
		// assume name attribute
		if (!is_array($attributes))
		{
			$attributes = array('name' => (string) $attributes);
		}
		
		$this->setAttributes($attributes);

		// setup Options
		foreach ($options as $label => $option_attributes)
		{
			if ($option_attributes instanceof Option)
			{
				$this->setChild($option_attributes);
			}
			else
			{
				$this->setChild(new Option($label, $option_attributes));
			}
		}

		parent::__construct();
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
		// you can't nest non-Option
		if (!($element instanceof Option))
		{
			throw new InvalidArgumentException('You cannot set anything other than Option as the child of Select.');
		}

		parent::setChild($element, $position);

		// overwrite default value with value from POST array
		if (!empty($_POST) && isset($_POST[$this->getAttribute('name')]))
		{
			$this->setValue($_POST[$this->getAttribute('name')]);
		}

		return $this;
	}

	/**
	 * Set field value
	 *
	 * @param	string	New value to be set
	 * @return	Reform\Field\Select
	 **/
	public function setValue($new_value)
	{
		foreach ($this->getChildren() as $element)
		{
			if ($element instanceof Option && $element->getValue() === $new_value)
			{
				$this->selectOption($element);
				break;
			}
		}
		
		return $this;
	}
	
	/**
	 * Get field value
	 *
	 * @return	string
	 **/
	public function getValue()
	{
		$selected_option = $this->getSelectedOption();

		return $selected_option instanceof Option ? $selected_option->getValue() : '';
	}
	
	/**
	 * Store reference to the selected Option
	 *
	 * @return	Reform\Field\Select
	 **/
	protected $_selectedOption;

	/**
	 * Set selected option
	 *
	 * @return	Reform\Field\Select
	 **/
	public function selectOption(Option $option)
	{
		$this->deselectOption();
		$option->setAttribute('selected', 'selected');
		$this->_selectedOption = $option;

		return $this;
	}

	/**
	 * Deselect the *currently selected* option
	 *
	 * @return	Reform\Field\Select
	 **/
	public function deselectOption()
	{
		if ($this->getSelectedOption() instanceof Option)
		{
			$this->_selectedOption->removeAttribute('selected');
		}

		$this->_selectedOption = NULL;

		return $this;
	}

	/**
	 * Get selected option
	 *
	 * @return	Reform\Field\Option or NULL
	 **/
	public function getSelectedOption()
	{
		return $this->_selectedOption instanceof Option ? $this->_selectedOption : NULL;
	}
}