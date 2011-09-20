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
class Label extends \Phormula\Element {
		
	protected $_tag_name = 'label';
	
	protected $_attributes = array();
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	public function __construct($text = '')
	{
		if (!empty($text))
		{
			$this->set_child_element($text);
		}
		
		return $this;
	}
}