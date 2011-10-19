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

namespace Reform\Elements;

/**
 * Element class
 **/
class Fieldset extends \Reform\Element {
		
	protected $_tag_name = 'fieldset';
	
	protected $_attributes = array();
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	public function __construct($attributes = array())
	{
		if (is_string($legend = $attributes))
		{
			if (!empty($legend))
			{
				$this->set_child(new Legend($legend));
			}
		}
		else if (is_array($attributes))
		{
			if (array_key_exists('legend', $attributes))
			{
				$this->set_child(new Legend($attributes['legend']));
				
				unset($attributes['legend']);
			}
			
			$this->set_attributes($attributes);
		}
		
		return $this;
	}
}