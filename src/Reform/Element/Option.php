<?php

/**
 * re:form
 *
 * re:form is an object oriented approach to creating, nesting, 
 * modifying, deleting, and validating forms in the DOM.
 *
 * @package    re:form
 * @author     Johnny Freeman
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @copyright  2011 Johnny Freeman All right reserved.
 * @link       https://github.com/johnnyfreeman/reform
 */

namespace Reform\Element;

use Reform\Field;

/**
 * Option class
 **/
class Option extends Field {
	
	protected $_tagName = 'option';
	
	protected $_attributes = array();
	
	protected $_childElements = array();
	
	protected $_parentElement;
	
	protected $_selfClosingTag = FALSE;
	
	/**
	 * Constructor
	 *
	 * @param	string	option's inner text
	 * @param	mixed	array of attributes or just the value (as a string)
	 * @return	void	
	 **/
	public function __construct($label = '', $attributes = array())
	{
		$this->setLabel($label);

		// assume value attribute
		if (!is_array($attributes))
		{
			$attributes = array('value' => (string) $attributes);
		}

		$this->setAttributes($attributes);

		parent::__construct();
	}
	
	/**
	 * ==============================================
	 * Methods for getting / setting textarea values
	 * ==============================================
	 **/
	
	/**
	 * Get field value
	 *
	 * @return	string
	 **/
	public function getValue()
	{
		$value = '';

		if ($this->hasAttribute('value'))
		{
			$value = $this->getAttribute('value');
		}
		
		// use nested text
		else
		{
			if (isset($this->_childElements[0]))
			{
				$value = $this->_childElements[0];
			}
		}

		return $value;
	}
	
	/**
	 * Set option label
	 *
	 * @param	string	label to be set
	 * @return	Reform\Field\Option
	 **/
	public function setLabel($label)
	{
		$this->_childElements[0] = $label;

		return $this;
	}
}