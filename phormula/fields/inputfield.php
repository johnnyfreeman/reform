<?php

/**
 * Phormula
 *
 * Phormula is an object oriented approach to creating, nesting, 
 * modifying, deleting, and validating form field elements in the DOM.
 *
 * @package    Phormula
 * @version    1.0 rc1
 * @author     Johnny Freeman
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @copyright  2011 Johnny Freeman
 * @link       http://code.johnnyfreeman.us/phormula
 */

namespace Phormula\Fields;

/**
 * Element class
 **/
class InputField extends \Phormula\Field {
		
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