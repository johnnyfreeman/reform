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
class Legend extends \Reform\Element {
		
	protected $_tag_name = 'legend';
	
	protected $_attributes = array();
	
	protected $_child_elements = array();
	
	protected $_parent_element;
	
	protected $_self_closing_tag = FALSE;
	
	public function __construct($text = '')
	{
		if (!empty($text))
		{
			$this->set_child($text);
		}
		
		return $this;
	}
}