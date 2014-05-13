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
 * @link       https://github.com/johnnyfreeman/reform
 */

namespace Reform\Field\Input;

/**
 * Hidden class
 **/
class Hidden extends Input {
	
	protected $_attributes = array(
			'name' => '',
			'type' => 'hidden',
			'value' => ''
		);
	
	protected $_childElements = array();
}