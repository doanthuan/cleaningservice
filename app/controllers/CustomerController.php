<?php
namespace App\Controllers;

use BaseController, Input, Auth, Session, Redirect, View, Hash, Validator, Mail;

class CustomerController extends BaseController {

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('auth', array('except' => array('getLogin', 'postLogin', 'getRegister', 'postRegister'
        ,'getUserFeedback', 'postUserFeedback') ));

        $this->beforeFilter('csrf', array('on' => 'post'));

    }

    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('customer/login');
    }

    public function getLogin()
    {
        // If logged in, redirect customer
        if (Auth::check())
        {
            return Redirect::to( 'customer/job-history' );
        }

        return View::make('customer.login');
    }

    public function postLogin()
    {
        $rules = array(
            'email'      =>  'required',
            'password'      =>  'required'
        );

        $loginValidator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success.
        if ( $loginValidator->passes() )
        {
            $loginDetails = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            // Try to log the user in.
            if ( Auth::attempt( $loginDetails ) )
            {
                //$user = Auth::user();
                //$user->last_login = date('Y-m-d H:i:s');
                //$user->save();

                return Redirect::intended('customer/job-history');
            }else{
                // Redirect to the login page.
                return Redirect::to('customer/login')->withErrors('Invalid email or password.' )->withInput();
            }
        }

        // Something went wrong.
        return Redirect::to('customer/login')->withErrors( $loginValidator->messages() )->withInput();
    }

    public function getRegister()
    {
        return View::make('customer.register');
    }

    public function postRegister()
    {

        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->passes()) {
            $customer = new User;
            $customer->fill(Input::all());
            $customer->password = Hash::make(Input::get('password'));
            $customer->status = User::STATUS_PENDING;
            $customer->save();

            //send email
            $data['username'] = Input::get('username');
            $recipient = Input::get('email');
            $token = Crypt::encrypt($recipient);

            $data['token'] = $token;
            Mail::send('emails.customer.register', $data, function($message) use($recipient)
            {
                $message->to($recipient)->subject('Welcome!');
            });

            return Redirect::to('customer/login')->with('success', 'Thank you for your registering.
                                    Please login to your email and activate your account.');
        } else {
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }
    }

    public function getProfile()
    {
        $customer = Auth::user();
        $data['customer'] = $customer;

        return View::make('customer.profile', $data);
    }

    public function postUpdateInfo()
    {
        $input = Input::all();
        $customer = \App\Helpers\Job::saveCustomer($input);
        if(!$customer){
            return Redirect::back()->withErrors(\App\Helpers\Job::getErrors())->withInput();
        }

        if(isset($input['stripeToken']))
        {
            $token = $input['stripeToken'];
            $key = \Config::get('maid.stripe_private_key');
            \Stripe::setApiKey($key);
            try {
                $cu = \Stripe_Customer::retrieve($customer->payment_info);
                $cu->card = $token; // obtained with Stripe.js
                $cu->save();
            } catch(\Stripe_CardError $e) {
                return Redirect::back()->withErrors('Credit card is invalid')->withInput();
            }
        }

        return Redirect::to('customer/job-profile')->with('success', 'Update profile successfully!');
    }


    public function getUserFeedback($id, $rating = null)
    {
        $job = \App\Models\Job::find($id);
        if(is_null($job))
        {
            throw new \Exception('Could not find record');
        }

//        if(!empty($job->rating)){
//            return Redirect::to('message')->withErrors('This job has already rated')->withInput();
//        }

//        $customer = Auth::user();
//        if($job->customer->customer_id != $customer->customer_id)
//        {
//            return Redirect::to('message')->withErrors('This job is not yours')->withInput();
//        }

        if(isset($rating)){
            $job->rating = $rating;
            $job->save();
        }

        $data['item'] = $job;

        return View::make('customer.user-feedback', $data);
    }

    public function postUserFeedback()
    {
        $input = Input::all();

        $item = new \App\Models\Job();
        $item->setData($input);
        $item->save();

        if(isset($input['yelp_confirm']) && $input['yelp_confirm'] == 1){
//            $url = \Config::get('maid.yelp_link');
//            return \Redirect::to($url);
            return Redirect::to('yelp-confirm');
        }

        return Redirect::to('message')->with('success', 'Job feedback completed.');
    }

    public function getJobHistory()
    {
        //get jobs list of customer
        $customer = Auth::user();
        $jobs = $customer->jobs()->with('team', 'serviceFrequency')->get();
        $data['jobs'] = $jobs;

        return View::make('customer.job-history', $data);
    }

    public function getJobRecurring()
    {
        //get jobs list of customer
        $customer = \Auth::user();
        $jobs = $customer->jobs()->with('team', 'serviceFrequency')
            ->where('service_frequency', '>', 1)
            ->where('recurringjob', 0)
            ->get();

        $data['jobs'] = $jobs;

        return View::make('customer.job-recurring', $data);
    }

    public function postJobRecurring()
    {
        $input = \Input::all();

        $job = \App\Models\Job::find($input['job_id']);
        if(!$job){
            return Redirect::back()->withErrors('Could not find job.')->withInput();
        }

        if(!isset($input['pause'])){
            return Redirect::back()->withErrors('Recurring param is null.')->withInput();
        }

        $recurringPause = $input['pause'];
        $job->recurring_pause = $recurringPause;
        $job->save();

        return Redirect::to('customer/job-recurring');
    }


}