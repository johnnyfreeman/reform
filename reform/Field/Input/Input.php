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

namespace Reform\Field\Input;

use Reform\Field\Field;

/**
 * Input class
 **/
class Input extends Field {
		
	protected $_tagName = 'input';
	
	protected $_attributes = array(
			'name' => '',
			'type' => 'text',
			'value' => ''
		);
	
	protected $_childElements = array();
	
	protected $_parentElement;
	
	protected $_selfClosingTag = TRUE;
	
	public function __construct($name, $value = '', $attributes = array())
	{
		// attributes is a string
		if (is_string($name))
		{
			$this->setAttribute('name', $name);
			$this->setAttribute('value', $value);
			$this->setAttributes($attributes);
		}
		else if (is_array($name))
		{
			$this->setAttributes($name);
		}

		// overwrite default value with value from POST array
		if (!empty($_POST) && isset($_POST[$this->getAttribute('name')]))
		{
			$this->setValue($_POST[$this->getAttribute('name')]);
		}
	}
}