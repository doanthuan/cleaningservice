<?php

namespace Goxob\Core\Helper;

use Form, Request, Input, URL;
use \Goxob\Core\Helper\Data;

class Html {

    public static function gridSort($text, $column, $orderDir, $orderBy)
    {
        $img = '';
        if($column == $orderBy)
        {
            $img = '<img src="'.url('img').'/sort_'.strtolower($orderDir).'.png" alt="">';

            $orderDir = $orderDir == 'ASC'?'DESC':'ASC';
        }
        else{
            $orderDir = 'ASC';
        }
        $html = '<a href="#" onclick="gridSort(\''.$column.'\', \''. $orderDir .'\');">'.$text.$img.'</a>';
        return $html;
    }

    public static function gridPublish($value, $i)
    {
        $status = $value == 1 ? 'publish' : 'unpublish';
        $value = $value == 1 ? 0 : 1;
        $task = 'publish';
        $href = '
		<a href="#" onclick="return listItemTask(\'cb' . $i . '\',\'' . $task . '\',\'' . $value . '\')" >
		<span class="state '.$status.'"></span>
		</a>';

        return $href;
    }

    public static function gridSortOrder($value)
    {
        $html = '<input type="text" name="order[]" size="5" value="'.$value.'">';
        return $html;
    }


    public static function message($message)
    {
        return '<div class="alert alert-success">'.$message.'</div>';
    }

    public static function error($message)
    {
        return '<div class="alert alert-danger">'.$message.'</div>';
    }


    public static function dropdown( $name, $selectedValue = '', array $attributes = array(), $collection,
                                     $fieldValue = '', $fieldDisplay = '', $extraOptions = array() )
    {
        $htmlAttributes = '';
        $attributes['name'] = $name;
        foreach($attributes as $key => $value)
        {
            $htmlAttributes .= "{$key}=\"{$value}\" ";
        }

        $extraHtmlOptions = '';
        if(!is_null($extraOptions))
        {
//            if(is_array($extraOptions) && count($extraOptions) == 0)//default value
//            {
//                $extraHtmlOptions = '<option value="" selected="selected">- Please Select -</option>';
//            }
            if(is_array($extraOptions) && count($extraOptions) > 0)
            {
                foreach($extraOptions as $value => $text)
                {
                    if($value === 'position') continue;
                    $extraHtmlOptions.= '<option value="'.$value.'">'.$text.'</option>';
                }
            }
        }
        $options = self::dropdownOptions($selectedValue, $collection, $fieldValue, $fieldDisplay);
        if(isset($extraOptions['position']) && $extraOptions['position'] === 'bottom'){
            $options = $options.$extraHtmlOptions;
        }
        else{
            $options = $extraHtmlOptions.$options;
        }

        $html = '<select '.$htmlAttributes.'>'.$options.'</select>';
        return $html;
    }

    public static function dropdownOptions($selectedValue  = '', $collection, $fieldValue = '', $fieldDisplay = '')
    {
        $html = '';
        foreach($collection as $key => $item)
        {
            if(!empty($fieldValue) && !empty($fieldDisplay)){
                $itemValue = $item->$fieldValue;
                $itemName = $item->$fieldDisplay;
            }
            else{
                if(Data::isAssocArray($collection))
                {
                    $itemValue = $key;
                    $itemName = $item;
                }
                else{
                    $itemValue = $item;
                    $itemName = $item;
                }
            }
            $selected = "";
            if(is_array($selectedValue) &&!empty($selectedValue) && in_array($itemValue, $selectedValue))
            {
                $selected = "selected='selected'";
            }
            elseif( (is_string($selectedValue) || is_numeric($selectedValue) ) && strlen($selectedValue) > 0 && $itemValue == $selectedValue  )
            {
                $selected = "selected='selected'";
            }

            //if category
            if(isset($item->tree_level))
            {
                $prefix = '';
                for($i = 0; $i < $item->tree_level; $i++)
                {
                    $prefix .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                }
                $itemName = $prefix.$itemName;
            }
            $html .= '<option value="'. $itemValue.'"'.$selected.'>'.$itemName.'</option>';
        }
        return $html;
    }

    public static function paginateLimitBox()
    {
        $options = array(10,20,30,50,100,200);
        $value = null;
        foreach($options as $pageSize)
        {
            $url = self::buildUrlWithPageSize($pageSize);
            $data[$url] = $pageSize;

            if(Input::get('limit') == $pageSize){
                $value = $url;
            }
        }

        if(!isset($value)){
            $defaultPageSize = 20;
            $value = self::buildUrlWithPageSize($defaultPageSize);
        }

        if(!isset($attributes['style'])){
            $attributes['style'] = 'height:26px';
        }

        $attributes['onchange'] = 'location = this.value;';
        $html = \Goxob\Core\Helper\Html::dropdown('limit', $value, $attributes,
            $data, null, null, null
        );
        return $html;
    }

    private static function buildUrlWithPageSize($pageSize)
    {
        $url = Url::current();

        $queryToAdd = array('limit' => $pageSize);
        $currentQuery = Input::query();
        $query = array_merge($currentQuery, $queryToAdd);
        unset($query['cid']);

        $query = http_build_query($query);
        $url .= '?'.$query;

        return $url;
    }




    public static function closeTags($html)
    {
        if(!empty($html)){
            $doc = new \DOMDocument();
            $doc->loadHTML($html);
            $yourText = $doc->saveHTML();
            return $yourText;
        }
    }
}