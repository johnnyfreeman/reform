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

namespace Phormula\Elements;

/**
 * Element class
 **/
class Fieldset extends \Phormula\Element {
		
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
				$this->set_child_element(new Legend($legend));
			}
		}
		else if (is_array($attributes))
		{
			if (array_key_exists('legend', $attributes))
			{
				$this->set_child_element(new Legend($attributes['legend']));
				
				unset($attributes['legend']);
			}
			
			$this->set_attributes($attributes);
		}
		
		return $this;
	}
}