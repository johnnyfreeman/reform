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

namespace Reform;

use Reform\Element\Fieldset;
use Reform\Element\Form;
use Reform\Element\Label;
use Reform\Element\Legend;
use Reform\Field\Input;
use Reform\Field\Input\Checkbox;
use Reform\Field\Input\Email;
use Reform\Field\Input\Password;
use Reform\Field\Input\Radio;
use Reform\Field\Input\Submit;
use Reform\Field\Select;
use Reform\Field\Option;
use Reform\Field\Textarea;
use Reform\Field\Button; // to be created

define('REFORM_PATH', realpath(__dir__) . DIRECTORY_SEPARATOR);

/**
 * Reform
 *
 * A façade for making the use of Reform easier.
 */
final class Reform
{
    private function __construct(){}
    
    /**
     * Form
     *
     * @param   mixed   array of attributes or just the action (as a string)
     * @return  Reform\Element\Form    
     **/
    public static function form($attributes='')
    {
        return new Form($attributes);
    }
    
    /**
     * Fieldset
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Element\Fieldset    
     **/
    public static function fieldset($attributes='')
    {
        return new Fieldset($attributes);
    }
    
    /**
     * Input
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Input    
     **/
    public static function input($name, $value = '', $attributes = array())
    {
        return new Input($name, $value, $attributes);
    }
    
    /**
     * Email
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Input\Email  
     **/
    public static function email($name, $value = '', $attributes = array())
    {
        return new Email($name, $value, $attributes);
    }
    
    /**
     * Password
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Input\Password  
     **/
    public static function password($name, $value = '', $attributes = array())
    {
        return new Password($name, $value, $attributes);
    }
    
    /**
     * Radio
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Input\Radio  
     **/
    public static function radio($name, $value = '', $attributes = array())
    {
        return new Radio($name, $value, $attributes);
    }
    
    /**
     * Submit
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Input\Submit  
     **/
    public static function submit($name, $value = '', $attributes = array())
    {
        return new Submit($name, $value, $attributes);
    }
    
    /**
     * Select
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Select 
     **/
    public static function select($attributes = array(), $options = array())
    {
        return new Select($attributes, $options);
    }
    
    /**
     * Option
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Option 
     **/
    public static function option($label, $attributes = array())
    {
        return new Option($label, $attributes);
    }
    
    /**
     * Textarea
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Select 
     **/
    public static function textarea($name, $value = '', $attributes = array())
    {
        return new Textarea($name, $value, $attributes);
    }
    
    /**
     * Label
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Element\Label 
     **/
    public static function label($text = '')
    {
        return new Label($text);
    }

    public static function registerAutoloader()
    {
        return spl_autoload_register('static::load', true, true);
    }

    // super quick autoloader for re:form
    // it is NOT recommended for use with anything other 
    // than loading reform objects
    private static function load($classname)
    {
        $class_map = array(

            // elements
            'Reform\\Element'           => REFORM_PATH.'Element.php',
            'Reform\\Element\\Fieldset' => REFORM_PATH.'Element/Fieldset.php',
            'Reform\\Element\\Form'     => REFORM_PATH.'Element/Form.php',
            'Reform\\Element\\Label'    => REFORM_PATH.'Element/Label.php',
            'Reform\\Element\\Legend'   => REFORM_PATH.'Element/Legend.php',

            // fields
            'Reform\\Field'                     => REFORM_PATH.'Field.php',
            'Reform\\Field\\Button'             => REFORM_PATH.'Field\\Button.php',
            'Reform\\Field\\Input'              => REFORM_PATH.'Field\\Input.php',
            'Reform\\Field\\Input\\Checkbox'    => REFORM_PATH.'Field\\Input\\Checkbox.php',
            'Reform\\Field\\Input\\Email'       => REFORM_PATH.'Field\\Input\\Email.php',
            'Reform\\Field\\Input\\Password'    => REFORM_PATH.'Field\\Input\\Password.php',
            'Reform\\Field\\Input\\Radio'       => REFORM_PATH.'Field\\Input\\Radio.php',
            'Reform\\Field\\Input\\Submit'      => REFORM_PATH.'Field\\Input\\Submit.php',
            'Reform\\Field\\Select'             => REFORM_PATH.'Field\\Select.php',
            'Reform\\Field\\Option'             => REFORM_PATH.'Field\\Option.php',
            'Reform\\Field\\Textarea'           => REFORM_PATH.'Field\\Textarea.php',

            // validation rules
            'Reform\\ValidationRule'                => REFORM_PATH.'ValidationRule.php',
            'Reform\\ValidationRule\\MatchesField'  => REFORM_PATH.'ValidationRule/MatchesField.php',
            'Reform\\ValidationRule\\MatchesValue'  => REFORM_PATH.'ValidationRule/MatchesValue.php',
            'Reform\\ValidationRule\\Required'      => REFORM_PATH.'ValidationRule/Required.php',

            // exceptions
            'Reform\\Exception\\ValidationFailedException' => REFORM_PATH.'Exception/ValidationFailedException.php',
        );

        if (array_key_exists($classname, $class_map) && is_readable($class_map[$classname]))
        {
            require_once($class_map[$classname]);
        }
    }
}