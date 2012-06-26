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

namespace Reform\Element;

use Reform\Exception\ValidationFailedException;

/**
 * Form class
 **/
class Form extends Element {
		
	protected $_tagName = 'form';
	
	protected $_attributes = array(
			'action' => '',
			'method' => 'post'
		);
	
	protected $_childElements = array();
	
	protected $_parentElement;
	
	protected $_selfClosingTag = FALSE;
	
	public function __construct($action = '')
	{
		if (is_string($action))
		{
			$this->setAttribute('action', $action);
		}
		// if $action is an array, assume 
		// it's an array of attributes
		else if (is_array($action))
		{
			$this->setAttributes($action);
		}
		
		return $this;
	}

	/**
	 * Recursively loops through all elements in a Form (and 
	 * it's children), running any validation rules it may have.
	 *
	 * @access	public
	 * @param	mixed	(bool) NULL or (object) Element
	 * @return	void
	 **/
	public function runValidation(Element $element = NULL)
	{
		// if no element is passed, get all children of this Form Field
		is_null($element) AND $children = $this->getChildren();

		// loopty loop
		foreach ($children as $child_element)
		{
			// if this childelement is a subclass of the Field object,
			// loop through it's rules and run each
			if (is_a($child_element, 'Reform\\Field'))
			{
				foreach ($child_element->getRules() as $rule)
				{
					try {
						$rule->run();
					}
					catch (ValidationFailedException $e)
					{
						$child_element->setError($e);
						$this->_errorCount++;
					}
				}
			}

			// if this childelement is NOT a subclass of the Field object and it has children,
			// loop through this whole process with it's children
			else if ($child_element->hasChildren())
			{
				$this->validate($child_element);
			}
		}

		$this->_validationRan = TRUE;
	}

	/**
	 * Has the validation already been run?
	 *
	 * @var	bool
	 **/
	protected $_validationRan = FALSE;

	/**
	 * ================================================
	 * Methods for working with ValidationRule objects
	 * ================================================
	 **/

	/**
	 * Number of ValidationFailedExceptions in this form
	 *
	 * @var	int
	 **/
	protected $_errorCount = 0;
	
	/**
	 * Checks if this form has any ValidationFailedExceptions
	 *
	 * @return	bool
	 **/
	public function isValid()
	{
		if (!$this->_validationRan)
		{
			$this->runValidation();
		}

		return $this->_errorCount === 0;
	}
}