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
class Fieldset extends Element {
		
	protected $_tagName = 'fieldset';
	
	protected $_attributes = array();
	
	protected $_childElements = array();
	
	protected $_parentElement;
	
	protected $_selfClosingTag = FALSE;
	
	public function __construct($attributes = '')
	{
		// assume non-array is legend
		if (!is_array($attributes)) {
			$attributes = array('legend' => $attributes);
		}

		// handle legend
		if (array_key_exists('legend', $attributes)) {
			if (!($attributes['legend'] instanceof Legend)) {
				$attributes['legend'] = new Legend($attributes['legend']);
			}
			
			$this->setChild($attributes['legend']);
			unset($attributes['legend']);
		}

		// set all attributes
		$this->setAttributes($attributes);
		
		parent::__construct();
	}
}