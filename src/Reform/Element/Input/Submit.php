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

/**
 * Submit class
 **/
class Submit extends Text {
	
	protected $_attributes = array(
			'name' => '',
			'type' => 'submit',
			'value' => ''
		);
	
	protected $_childElements = array();
}