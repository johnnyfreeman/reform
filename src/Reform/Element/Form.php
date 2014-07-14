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
use Reform\Field;
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
		
		parent::__construct();
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
		$children = is_null($element) ? $this->getChildren() : $element->getChildren();

		// loopty loop
		foreach ($children as $child_element)
		{
			// if this childelement is a subclass of the Field object,
			// loop through it's rules and run each
			if ($child_element instanceof Field)
			{
				if (!$child_element->isValid())
				{
					$this->_errorCount++;
				}
			}

			// if this childelement is NOT a subclass of the Field object and it has children,
			// loop through this whole process with it's children
			else if ($child_element instanceof Element)
			{
				$this->runValidation($child_element);
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
	 * Checks if the form has been validated and is valid
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
	
	/**
	 * Get for child fields of this form
	 *
	 * @return	array	Returns an array of ValidationFailedException objects
	 **/
	public function getErrors(Element $element = NULL)
	{
		$errors = array();

		// if no element is passed, get all children of this Form Field
		$children = is_null($element) ? $this->getChildren() : $element->getChildren();

		// loopty loop
		foreach ($children as $child_element)
		{
			// if this childelement is a subclass of the Field object,
			// loop through it's rules and run each
			if ($child_element instanceof Field)
			{
				$errors = array_merge($errors, $child_element->getErrors());
			}

			// if this childelement is NOT a subclass of the Field object and it has children,
			// loop through this whole process with it's children
			else if ($child_element instanceof Element)
			{
				$errors = array_merge($errors, $this->getErrors($child_element));
			}
		}

		return $errors;
	}

	/**
	 * Check if this field has any errors
	 *
	 * @return	boolean	Returns True of False
	 **/
	public function hasErrors()
	{
		return count($this->getErrors()) > 0 ? TRUE : FALSE;
	}

	// defer validation until just before printing to string
	public function __toString()
	{
		if (!empty($_POST) && !$this->_validationRan)
		{
			$this->runValidation();
		}

		return parent::__toString();
	}
}


