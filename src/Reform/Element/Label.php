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

use Reform\Element;

/**
 * Element class
 **/
class Label extends Element {
		
	protected $_tagName = 'label';
	
	protected $_attributes = array();
	
	protected $_childElements = array();
	
	protected $_parentElement;
	
	protected $_selfClosingTag = FALSE;
	
	public function __construct($text = '')
	{
		if (!empty($text))
		{
			$this->setChild($text);
		}
		
		return $this;
	}
}