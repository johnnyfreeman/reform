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
class SelectField extends \Reform\Field {
		
	protected $_tag_name = 'select';
	
	
	protected $_attributes = array(
			'name' => ''
		);
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	public function __construct($name, $options = array(), $attributes = array())
	{
		// attributes is a string
		if (is_string($name))
		{
			$this->set_attribute('name', $name);
			
			foreach ($options as $value => $label)
			{
				$this->set_child_element(new OptionField($label, $value));
			}
			
			$this->set_attributes($attributes);
		}
		else if (is_array($name))
		{
			$this->set_attributes($name);
		}
		
		return parent::__construct();
	}
}