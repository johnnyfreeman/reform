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

namespace Reform\Field\Input;

/**
 * Password class
 **/
class Password extends Input {
	
	protected $_attributes = array(
			'name' => '',
			'type' => 'password',
			'value' => ''
		);
	
	protected $_childElements = array();
}