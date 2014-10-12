<?php
namespace App\Controllers;

use BaseController, Input, Auth, Session, Redirect, View, Hash, Validator, Mail;

class JobController extends BaseController {

    public function postBooking()
    {
        $result = \App\Helpers\Job::bookAppointment(Input::all());
        if(!$result){
            return Redirect::back()->withErrors(\App\Helpers\Job::getErrors())->withInput();
        }

        return Redirect::to('customer/login')->with('success', 'Thank you for your registering.');
    }

    public function getTestEmail()
    {
        $data = array();
        \Mail::send('emails.test', $data, function($message)
        {
            $message->to('doanvuthuan@gmail.com')->subject("Test Email");
        });
        echo 'ok';exit;
    }

}