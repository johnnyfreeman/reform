<?php

define('PHORMULA_PATH', realpath(__dir__) . DIRECTORY_SEPARATOR);


function __autoload($class_name)
{
	// set class alias' so that users don't have 
	// to use long namespaces in there calls
	$class_aliases = array(
		
		// elements
		'Fieldset'     	=> 'Phormula\\Elements\\Fieldset',
		'Form'     		=> 'Phormula\\Elements\\Form',
		'Label'     	=> 'Phormula\\Elements\\Label',
		'Legend'     	=> 'Phormula\\Elements\\Legend',
		
		// fields
		'InputField'     	=> 'Phormula\\Fields\\InputField',
			'CheckboxField' => 'Phormula\\Fields\\InputFields\\CheckboxField',
			'EmailField'    => 'Phormula\\Fields\\InputFields\\EmailField',
			'PasswordField' => 'Phormula\\Fields\\InputFields\\PasswordField',
			'RadioField'    => 'Phormula\\Fields\\InputFields\\RadioField',
			'SubmitField'   => 'Phormula\\Fields\\InputFields\\SubmitField',
		'SelectField'   	=> 'Phormula\\Fields\\SelectField',
		'OptionField'   	=> 'Phormula\\Fields\\OptionField',
		'TextAreaField' 	=> 'Phormula\\Fields\\TextAreaField',
		
		'Validation'     	=> 'Phormula\\Validation'
		
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
	if ($path[0] == "Phormula")
	{
		array_shift($path);
	}
	
	// exchange namespace slashes for directory slashes
	is_array($path) && $path = implode(DIRECTORY_SEPARATOR, $path);
	
	// build path (all filenames are lowercase)
	$path = PHORMULA_PATH . strtolower($path) . '.php';
	
	// include it if it the path is a valid file path
	if (file_exists($path))
	{
		require_once($path);
	}
}