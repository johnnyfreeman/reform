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
class SubmitField extends \Phormula\Fields\InputField {
	
	protected $_attributes = array(
			'name' => '',
			'type' => 'submit',
			'value' => ''
		);
	
	protected $_child_elements = array();


	public function __construct($value = '', $attributes = array())
	{
		return parent::__construct('', $value, $attributes);
	}
}