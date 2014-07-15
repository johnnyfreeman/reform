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

namespace Reform;

use BadMethodCallException;

/**
 * Form Builder
 *
 * This is a static interface to make working with 
 * reform a little easier.
 */
class Reform
{   
    /**
     * Form
     *
     * @param   mixed   array of attributes or just the action (as a string)
     * @return  Reform\Element\Form    
     **/
    public static function form($attributes='')
    {
        return new \Reform\Element\Form($attributes);
    }
    
    /**
     * Fieldset
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Element\Fieldset    
     **/
    public static function fieldset($attributes='')
    {
        return new \Reform\Element\Fieldset($attributes);
    }
    
    /**
     * Input
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  mixed   Reform\Element\Input\Text or type-specific class
     **/
    public static function input(Array $attributes)
    {
        // fallback to Text class
        if (!isset($attributes['type']) || !in_array($attributes['type'], static::$inputTypes)) {
            $attributes['type'] = 'text';
        }

        // build derived classname from field type
        $class = '\\Reform\\Element\\Input\\' . ucfirst(strtolower($attributes['type']));

        return new $class($attributes);
    }

    public static $inputTypes = array('text', 'email', 'hidden', 'password', 'radio', 'submit');

    /**
     * Input methods
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  mixed   Reform\Element\Input\Text or type-specific class
     **/
    public static function __callStatic($name, $arguments)
    {
        if (!in_array($name, static::$inputTypes)) {
            throw new BadMethodCallException;
        }

        // get first argument
        $attributes = $arguments[0];

        // set non-array type as a sensable attribute
        if (!is_array($attributes)) {
            switch ($name) {
                case 'submit':
                    $attributes = array('value' => (string) $attributes);
                    break;
                
                default:
                    $attributes = array('name' => (string) $attributes);
                    break;
            }
        }

        // set input type
        $attributes = array_merge(array('type'=>$name), $attributes);

        return static::input($attributes);
    }
    
    /**
     * Select
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Select 
     **/
    public static function select($attributes = array(), $options = array())
    {
        return new \Reform\Element\Select($attributes, $options);
    }
    
    /**
     * Textarea
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Field\Textarea 
     **/
    public static function textarea($name, $value = '', $attributes = array())
    {
        return new \Reform\Element\Textarea($name, $value, $attributes);
    }
    
    /**
     * Label
     *
     * @param   mixed   array of attributes or just the legend (as a string)
     * @return  Reform\Element\Label 
     **/
    public static function label($text = '')
    {
        return new \Reform\Element\Label($text);
    }
}