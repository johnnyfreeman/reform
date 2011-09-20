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

namespace Phormula\Fields\InputFields;

/**
 * Element class
 **/
class RadioField extends \Phormula\Fields\InputField {
	
	protected $_attributes = array(
			'name' => '',
			'type' => 'radio',
			'value' => ''
		);
	
	protected $_child_elements = array();
}