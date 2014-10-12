<?php

namespace Goxob\Core\Helper;

use Mail;

class Email {
    public static function send($template, $data = array(), $recipient, $subject, $fromAddress = '', $fromName = '')
    {
        $data['siteUrl'] = url('');
        $storeName = 'MaidSavvy';
        $data['siteName'] = $storeName;

        if(empty($fromAddress)){
            //$fromAddress = \Goxob::getSetting('store.admin_email');
            $fromAddress = 'support@maidsavvy.com';
        }
        if(empty($fromName)){
            $fromName = 'Goxob';
        }
        Mail::queue($template, $data, function($message) use($recipient, $subject, $fromAddress, $fromName)
        {
            $message->from($fromAddress, $fromName);
            $message->to($recipient)->subject($subject);
        });
    }
}