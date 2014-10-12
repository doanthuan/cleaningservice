<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 5/21/14
 * Time: 9:34 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Core\Html;

use View;

class Toolbar {

    protected static $title;
    protected static $buttons;

    const BUTTON_CREATE = 'create';
    const BUTTON_DELETE = 'delete';
    const BUTTON_SAVE = 'save';
    const BUTTON_CANCEL = 'cancel';
    const BUTTON_BACK = 'back';
    const BUTTON_REDIRECT = 'redirect';
    const BUTTON_SUBMIT = 'submit';
    const BUTTON_UPLOAD = 'upload';
    const BUTTON_PUBLISH = 'publish';
    const BUTTON_UNPUBLISH = 'unpublish';
    const BUTTON_CLICK = 'click';

    public static function title($title)
    {
        static::$title = $title;
    }

    public static function buttons(array $buttons)
    {
        static::$buttons = $buttons;
    }

    public static function redirectButton($label, $url)
    {
        static::$buttons[] = array('type' => static::BUTTON_REDIRECT, 'label' => $label, 'url' => $url);
    }

    public static function submitButton($label, $url = '')
    {
        static::$buttons[] = array('type' => static::BUTTON_SUBMIT, 'label' => $label, 'action' => $url);
    }

    public static function clickButton($label, $onclick = '')
    {
        static::$buttons[] = array('type' => static::BUTTON_CLICK, 'label' => $label, 'onclick' => $onclick);
    }

    public static function toHtml()
    {
        $data['title'] = '';
        $data['buttons'] = array();
        if(isset(static::$title))
        {
            $data['title'] = static::$title;
        }
        if(isset(static::$buttons))
        {
            $buttons = array();
            foreach(static::$buttons as $button)
            {
                if(is_string($button))
                {
                    $button = array('type' => $button);
                }
                $buttons[] = $button;
            }
            $data['buttons'] = $buttons;
        }
        if(isset($data))
        {
            return View::make('admin.layouts.partials.toolbar', $data)->render();
        }
        return null;
    }

}