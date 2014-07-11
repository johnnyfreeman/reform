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
	
	public function __construct($attributes = array(), $options = array())
	{
		// assume name attribute
		if (!is_array($attributes))
		{
			$attributes = array('name' => (string) $attributes);
		}
		
		$this->setAttributes($attributes);

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
		
		// overwrite default value with value from POST array
		if (!empty($_POST) && isset($_POST[$this->getAttribute('name')]))
		{
			$this->setValue($_POST[$this->getAttribute('name')]);
		}
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
		$this->_selectedOption->removeAttribute('selected');
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