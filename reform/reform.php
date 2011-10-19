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

/**
 * This is the bootstrap file. Simply include this 
 * in your application or website and begin using 
 * our api to create forms easier.
 */

define('REFORM_PATH', realpath(__dir__) . DIRECTORY_SEPARATOR);

function __autoload($class_name)
{
	// set class alias' so that users don't have 
	// to use long namespaces in there calls
	$class_aliases = array(
		
		// elements
		'Fieldset'     	=> 'Reform\\Elements\\Fieldset',
		'Form'     		=> 'Reform\\Elements\\Form',
		'Label'     	=> 'Reform\\Elements\\Label',
		'Legend'     	=> 'Reform\\Elements\\Legend',
		
		// fields
		'Input'     	=> 'Reform\\Fields\\Input',
			'Checkbox' 	=> 'Reform\\Fields\\Inputs\\Checkbox',
			'Email'    	=> 'Reform\\Fields\\Inputs\\Email',
			'Password' 	=> 'Reform\\Fields\\Inputs\\Password',
			'Radio'    	=> 'Reform\\Fields\\Inputs\\Radio',
			'Submit'   	=> 'Reform\\Fields\\Inputs\\Submit',
		'Select'   		=> 'Reform\\Fields\\Select',
		'Option'   		=> 'Reform\\Fields\\Option',
		'Textarea'		=> 'Reform\\Fields\\Textarea'
		
	);
	
	// Check if class being called is an alias to another class.
	// If so, register the class alias and overwrite the 
	// $class_name variable to reflect the real class name.
	if (array_key_exists($class_name, $class_aliases))
	{
		$class_alias = $class_aliases[$class_name];
		class_alias($class_alias, $class_name);
		$class_name = $class_alias;
	}
	
	// get path to file from the class name
	$path = explode('\\', $class_name);
	
	// remove "Phormula" from the path if it exists
	if ($path[0] == "Reform")
	{
		array_shift($path);
	}
	
	// exchange namespace slashes for directory slashes
	is_array($path) && $path = implode(DIRECTORY_SEPARATOR, $path);
	
	// build path (all filenames are lowercase)
	$path = REFORM_PATH . strtolower($path) . '.php';
	
	// include it if it the path is a valid file path
	if (file_exists($path))
	{
		require_once($path);
	}
}