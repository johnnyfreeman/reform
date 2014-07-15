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

namespace Reform\Field;

use Reform\Field;

/**
 * Textarea class
 **/
class Textarea extends Field {
		
	protected $_tagName = 'textarea';
	
	protected $_attributes = array(
		'name' => ''
	);
	
	protected $_childElements = array();
	
	protected $_parentElement;
	
	protected $_selfClosingTag = FALSE;
	
	public function __construct($attributes)
	{
		if (!is_array(attributes)) {
			$attributes = array('name' => (string) $attributes);
		}

		$this->setAttributes($attributes);

		parent::__construct();

		// overwrite value with value from the post array
		if (!empty($_POST) && isset($_POST[$this->getAttribute('name')]))
		{
			$this->setValue($_POST[$this->getAttribute('name')]);
		}
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
	public function setValue($value)
	{
		$this->_childElements = array($value);
		
		return $this;
	}
	
	/**
	 * Get field value
	 *
	 * @param	string	Value to be set
	 * @return	object	Returns the current element (object) to allow method chaining
	 **/
	public function getValue()
	{
		return isset($this->_childElements[0]) ? $this->_childElements[0] : '';
	}

	/**
	 * Since this really can't have nested elements 
	 * inside it we want to prevent such actions 
	 * by overriding the default methods.
	 **/
	//public function getChildren() {	return array();	}
	//public function setChild($element, $position = 'bottom') { return $this; }
	//public function hasChildren() { return FALSE; }
	//public function append($elements = array()) { return $this; }
	//public function prepend($elements = array()) { return $this;}
}