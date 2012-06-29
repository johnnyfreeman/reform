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

namespace Reform;

define('REFORM_PATH', realpath(__dir__) . DIRECTORY_SEPARATOR);

/**
 * Class Loader
 *
 * Super quick classloader for re:form
 * It is NOT recommended for use with anything other 
 * than loading reform objects
 */
abstract class ClassLoader
{
    public static function register()
    {
        return spl_autoload_register('static::load', true, true);
    }

    private $_class_map = array(

        // tools
        'Reform\\FormBuilder' => REFORM_PATH.'Formbuilder.php',

        // elements
        'Reform\\Element\\Element'  => REFORM_PATH.'Element/Element.php',
        'Reform\\Element\\Fieldset' => REFORM_PATH.'Element/Fieldset.php',
        'Reform\\Element\\Form'     => REFORM_PATH.'Element/Form.php',
        'Reform\\Element\\Label'    => REFORM_PATH.'Element/Label.php',
        'Reform\\Element\\Legend'   => REFORM_PATH.'Element/Legend.php',

        // fields
        'Reform\\Field\\Field'              => REFORM_PATH.'Field/Field.php',
        'Reform\\Field\\Button'             => REFORM_PATH.'Field/Button.php',
        'Reform\\Field\\Input\\Input'       => REFORM_PATH.'Field/Input/Input.php',
        'Reform\\Field\\Input\\Checkbox'    => REFORM_PATH.'Field/Input/Checkbox.php',
        'Reform\\Field\\Input\\Email'       => REFORM_PATH.'Field/Input/Email.php',
        'Reform\\Field\\Input\\Password'    => REFORM_PATH.'Field/Input/Password.php',
        'Reform\\Field\\Input\\Radio'       => REFORM_PATH.'Field/Input/Radio.php',
        'Reform\\Field\\Input\\Submit'      => REFORM_PATH.'Field/Input/Submit.php',
        'Reform\\Field\\Select'             => REFORM_PATH.'Field/Select.php',
        'Reform\\Field\\Option'             => REFORM_PATH.'Field/Option.php',
        'Reform\\Field\\Textarea'           => REFORM_PATH.'Field/Textarea.php',

        // validation rules
        'Reform\\ValidationRule\\ValidationRule'    => REFORM_PATH.'ValidationRule/ValidationRule.php',
        'Reform\\ValidationRule\\MatchesField'      => REFORM_PATH.'ValidationRule/MatchesField.php',
        'Reform\\ValidationRule\\MatchesValue'      => REFORM_PATH.'ValidationRule/MatchesValue.php',
        'Reform\\ValidationRule\\Required'          => REFORM_PATH.'ValidationRule/Required.php',

        // exceptions
        'Reform\\Exception\\ValidationFailedException' => REFORM_PATH.'Exception/ValidationFailedException.php',

        // examples
        'Reform\\Examples\\ContactForm\\ContactForm' => realpath(__dir__.'/..').'/examples/ContactForm/ContactForm.php',
        'Reform\\Examples\\ContactForm\\ContactName' => realpath(__dir__.'/..').'/examples/ContactForm/ContactName.php',
        'Reform\\Examples\\ContactForm\\ContactEmail' => realpath(__dir__.'/..').'/examples/ContactForm/ContactEmail.php',
        'Reform\\Examples\\ContactForm\\ContactMessage' => realpath(__dir__.'/..').'/examples/ContactForm/ContactMessage.php',
    
    );

    private static function load($class_name)
    {
        if (array_key_exists($class_name, $this->_class_map) && is_readable($class_map[$class_name]))
        {
            require_once($class_map[$class_name]);
        }
    }
}