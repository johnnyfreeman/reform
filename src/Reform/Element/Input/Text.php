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

namespace Reform\Element\Input;

use Reform\Field;

/**
 * Generic Input class
 **/
class Text extends Field {
		
	protected $_tagName = 'input';
	
	protected $_attributes = array(
			'name' => '',
			'type' => 'text',
			'value' => ''
		);
	
	protected $_childElements = array();
	
	protected $_parentElement;
	
	protected $_selfClosingTag = TRUE;
	
	public function __construct(Array $attributes)
	{
		$this->setAttributes($attributes);

		parent::__construct();

		// overwrite default value with value from POST array
		if (!empty($_POST) && isset($_POST[$this->getAttribute('name')]))
		{
			$this->setValue($_POST[$this->getAttribute('name')]);
		}
	}
}