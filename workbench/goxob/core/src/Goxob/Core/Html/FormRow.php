<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 5/22/14
 * Time: 8:50 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Core\Html;
use Form, Input;

class FormRow {

    public static $type = 'horizontal';

    public static function field($type, $label, $name, $value = null, $attributes = array(), $data = array(),
                                 $wrapperClass = null)
    {
        //input
        $input = self::getInput($type, $name, $value, $attributes, $data);

        //label
        $label = self::wrapLabel($type, $label, $name);

        //wrapper field
        $html = static::wrapField($type, $label, $input, $wrapperClass);

        //wrapper row
        $html = '<div class="form-group">'.$html.'</div>';
        return $html;
    }


    public static function __callStatic($method, $arguments)
    {
        $fields = array('text', 'textarea', 'checkbox', 'radio', 'hidden', 'file' ,'dropdown');
        if(in_array($method, $fields))
        {
            $num_args = count($arguments);
            switch($num_args)
            {
                case 2:
                    return static::field($method, $arguments[0], $arguments[1]);
                case 3:
                    return static::field($method, $arguments[0], $arguments[1], $arguments[2]);
                case 4:
                    return static::field($method, $arguments[0], $arguments[1], $arguments[2], $arguments[3]);
                case 5:
                    return static::field($method, $arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4]);
                case 6:
                    return static::field($method, $arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5]);
            }
        }
    }

    protected static function getInput($type, $name, $value = null, $attributes = array(), $data = array())
    {
        //attributes
        if(is_null($attributes))
        {
            $attributes = array();
        }
        if(!isset($attributes['class']) && $type != 'checkbox')
        {
            $attributes['class'] = 'form-control';
        }
        else if(isset($attributes['class']) && $type != 'checkbox')
        {
            $attributes['class'] = 'form-control '.$attributes['class'];
        }
        if(isset($attributes['required']))
        {
            $attributes['required'] = 'required';
        }


        //get html field
        $fieldHtml = '';
        if($type == 'textarea')
        {
            $fieldHtml .= Form::textarea($name, $value, $attributes);
        }
        else if($type == 'file')
        {
            $fieldHtml .= Form::file($name, $value, $attributes);
        }
        else if($type == 'dropdown')
        {
            if(!isset($data['field_value']))
            {
                $data['field_value'] = null;
            }
            if(!isset($data['field_name']))
            {
                $data['field_name'] = null;
            }
            if(!isset($data['extraOptions']))
            {
                $data['extraOptions'] = array();
            }
            if(is_string($value) && strlen($value) == 0)
            {
                $value = Input::old($name);
            }
            elseif(is_array($value) && empty($value))
            {
                $value = Input::old($name);
            }

            $fieldHtml .= \Goxob\Core\Helper\Html::dropdown( $name, $value,
                $attributes,
                $data['collection'],
                $data['field_value'],
                $data['field_name'],
                $data['extraOptions']
            );
        }
        else
        {
            $fieldHtml .= Form::input($type, $name, $value, $attributes);
        }

        return $fieldHtml;
    }

    protected static function wrapLabel($type, $label, $name)
    {
        if(!empty($label)){
            $labelAttributes = array();
            if(self::$type == 'horizontal'){
                if($type != 'checkbox')
                {
                    $labelAttributes = array('class' => 'col-sm-2 control-label');
                }
            }

            $label = trans($label);
            $label = Form::label($name, $label, $labelAttributes);

            return $label;
        }
    }

    protected static function wrapField($type, $label, $input, $wrapperClass = null)
    {
        if(self::$type == 'horizontal'){
            if($type == 'checkbox'){
                $html = '<div class="col-sm-offset-2 col-sm-10"><div class="checkbox">'.$input.$label.'</div></div>';
            }
            else{
                if(!isset($wrapperClass)){
                    $wrapperClass = 'col-sm-10';
                }
                $html = $label.'<div class="'.$wrapperClass.'">'.$input.'</div>';
            }
        }
        else{
            $html = $label.$input;
        }
        return $html;
    }

}