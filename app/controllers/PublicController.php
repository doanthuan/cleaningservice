<?php
namespace App\Controllers;

use BaseController, View;
class PublicController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
    protected $ignoreCsrf = true;
    public function __construct()
    {
        parent::__construct();

        //$this->beforeFilter('csrf',  array('except' => 'checkZipCode'));
        $this->beforeFilter('csrf', array('on' => 'post', 'except' => 'checkZipCode'));
    }

	public function index()
	{
		return View::make('public.index');
	}

    public function booking()
    {
        return View::make('public.booking');
    }

    public function faqs()
    {
        return View::make('public.faqs');
    }

    public function locations()
    {
        return View::make('public.locations');
    }

    public function pricing()
    {
        return View::make('public.pricing');
    }

    public function contactUs()
    {
        $customer = \Auth::user();
        return View::make('public.contact-us',compact('customer'));
    }

    public function postContact()
    {
        $data['firstName'] = \Input::get('first_name');
        $data['lastName'] = \Input::get('last_name');
        $data['emailAddress'] = \Input::get('email');
        $data['content'] = \Input::get('message');

        $recipient = \Input::get('email');
        \Mail::send('emails.contact', $data, function($message) use($recipient)
        {
            $adminEmail = \Config::get('maid.admin_email');
            $companyName = \Config::get('maid.company_name');

            $message->to($recipient)->subject("[$companyName] Contact!")->cc($adminEmail);
        });

        return \Redirect::to('message')->with('success', 'Contact Us Successfully!');
    }

    public function privacyPolicy()
    {
        return View::make('public.privacy-policy');
    }

    public function terms()
    {
        return View::make('public.terms');
    }

    public function message()
    {
        return View::make('public.message');
    }

    public function getPurchaseGiftcard()
    {
        return View::make('public.giftcard');
    }

    public function postPurchaseGiftcard()
    {
        $result = \App\Helpers\GiftCard::purchase(\Input::all());
        if(!$result){
            return Redirect::back()->withErrors(\App\Helpers\GiftCard::getErrors())->withInput();
        }

        return \Redirect::to('message')->with('success', 'Purchase Gift Card Successfully.');
    }

    public function checkZipCode()
    {
        $zipcode = \Input::get('zipcode');

        $count = \App\Models\ZipCode::where('zipcode', $zipcode)->count();
        $isAvailable = false;
        if($count > 0){
            $isAvailable = true;
        }
        echo json_encode(array(
            'valid' => $isAvailable,
        ));
    }

    public function getYelpConfirm()
    {
        return View::make('public.yelp-confirm');
    }

    public function getTest()
    {
        //$password = \Hash::make('Rabbits425');
        //echo $password;exit;
       
       // $monthDiff = \App\Helpers\Job::datediff('m', "2014-09-03", date('Y-m-d H:i:s'));
        //$test = date(); //strtotime();
        //$monthDiff += 1;
        //$modify = '+'.$monthDiff.' month';
        //$takeTime = strtotime($modify, strtotime("2014-09-03"));
        //$new_date = date('Y-m-d H:i:s', $takeTime);
        //echo $monthDiff."<br>".$modify."<br>".$takeTime."<br>".$new_date ;
        /*
        $results = \DB::select('select * from job as j1 where j1.status in (?,?,?,?) and j1.recurringjob = 0
                            and j1.recurring_pause = 0
                            and exists (
                                select 1 from customer where j1.customer_id = customer.customer_id and customer.service_frequency >= 2
                            )', array(\App\Models\Job::STATUS_COMPLETED, \App\Models\Job::STATUS_PAID, \App\Models\Job::STATUS_PAID_TEAM, \App\Models\Job::STATUS_CANCELED));
         
         //echo $jobs['service_extras'];
         
         echo "<pre>";
         print_r($results);
         echo "</pre>";
         */
        exit;
    }
}