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

use Reform\Element\Fieldset;
use Reform\Element\Form;
use Reform\Element\Label;
use Reform\Element\Legend;
use Reform\Field\Input\Input;
use Reform\Field\Input\Checkbox;
use Reform\Field\Input\Email;
use Reform\Field\Input\Hidden;
use Reform\Field\Input\Password;
use Reform\Field\Input\Radio;
use Reform\Field\Input\Submit;
use Reform\Field\Select;
use Reform\Field\Option;
use Reform\Field\Textarea;
use Reform\Field\Button;

/**
 * Form Builder
 *
 * This is a static interface to make working with 
 * reform a little easier.
 */
class Reform
{
    public function __construct(){}
    
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
     * @return  Reform\Field\Input\Input    
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
     * Hidden
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Input\Hidden  
     **/
    public static function hidden($name, $value = '', $attributes = array())
    {
        return new Hidden($name, $value, $attributes);
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
}