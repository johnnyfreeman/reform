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
    public static function input($attributes)
    {
        // accept string as name attribute
        if (!is_array($attributes)) {
            $attributes = array('name'=>$attributes);
        }

        // default class
        $class = '\\Reform\\Element\\Input\\Text';

        // build derived classname from field type
        if (isset($attributes['type'])) {
            $derivedClass = '\\Reform\\Element\\Input\\' . ucfirst(strtolower($attributes['type']));
            if (class_exists($derivedClass)) {
                $class = $derivedClass;
            }
        }

        return new $class($attributes);
    }

    public static function email($attributes)
    {
        // accept string as name attribute
        if (!is_array($attributes)) {
            $attributes = array('name'=>$attributes);
        }

        return static::input(array_merge(array('type'=>'email'), $attributes));
    }

    public static function hidden($attributes)
    {
        // accept string as name attribute
        if (!is_array($attributes)) {
            $attributes = array('name'=>$attributes);
        }
        
        return static::input(array_merge(array('type'=>'hidden'), $attributes));
    }

    public static function password($attributes)
    {
        // accept string as name attribute
        if (!is_array($attributes)) {
            $attributes = array('name'=>$attributes);
        }
        
        return static::input(array_merge(array('type'=>'password'), $attributes));
    }

    public static function radio($attributes)
    {
        // accept string as name attribute
        if (!is_array($attributes)) {
            $attributes = array('name'=>$attributes);
        }
        
        return static::input(array_merge(array('type'=>'radio'), $attributes));
    }

    public static function submit($attributes)
    {
        // accept string as value attribute
        if (!is_array($attributes)) {
            $attributes = array('value'=>$attributes);
        }
        
        return static::input(array_merge(array('type'=>'submit'), $attributes));
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