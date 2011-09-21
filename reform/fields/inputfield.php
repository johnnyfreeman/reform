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
 * Element class
 **/
class InputField extends \Reform\Field {
		
	protected $_tag_name = 'input';
	
	protected $_attributes = array(
			'name' => '',
			'type' => 'text',
			'value' => ''
		);
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = TRUE;
	
	public function __construct($name, $value = '', $attributes = array())
	{
		// attributes is a string
		if (is_string($name))
		{
			$this->set_attribute('name', $name);
			$this->set_attribute('value', $value);
			$this->set_attributes($attributes);
		}
		else if (is_array($name))
		{
			$this->set_attributes($name);
		}

		parent::__construct();
	}
}