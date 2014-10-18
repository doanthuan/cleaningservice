<?php
namespace App\Controllers\Admin;

use BaseController, Input, Redirect, View, Str;
use Goxob\Core\Controller\AdminController;
use Goxob\Core\Html\Toolbar;

class JobController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\Models\Job();
    }

    public function anyIndex()
    {
        Toolbar::title('Jobs');
        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 1){
            Toolbar::buttons(array(Toolbar::BUTTON_CREATE, Toolbar::BUTTON_DELETE)) ;
            //Toolbar::buttons(array(Toolbar::BUTTON_CREATE)) ;
        }

        return View::make('admin.job.index');
    }

    public function getCreate()
    {
        Toolbar::title('New Job');
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $item = $this->model;
        $data['item'] = $item;

        $customer = new \App\Models\Customer();
        $data['customer'] = $customer;

        return View::make('admin.job.edit', $data);
    }

    public function getEdit()
    {
        Toolbar::title('Edit Job');
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $job = $this->model->find(Input::get('id'));
        if(is_null($job))
        {
            throw new \Exception('Could not find record');
        }
        $customer = $job->customer;

        $data['item'] = $job;
        $data['customer'] = $customer;

        return View::make('admin.job.edit', $data);
    }

    public function postEdit()
    {
        $result = \App\Helpers\Job::bookAppointment(Input::all());
        if(!$result){
            return Redirect::back()->withErrors(\App\Helpers\Job::getErrors())->withInput();
        }

        return Redirect::to('admin/job')->with('success', 'Booking Job Successfully.');
    }


    public function getCharge()
    {
        $title = trans('Charge Customers');
        Toolbar::title($title);

        return View::make('admin.job.job-completed');
    }

    public function chargeJob()
    {
        $jobId = Input::get('params');

        $job = \App\Models\Job::find($jobId);
        if(!$job){
            return Redirect::back()->withErrors('Could not find job')->withInput();
        }
        $customer = $job->customer;

        $amount = $job->amount * 100;

        if($amount >= 50){
            try{
                $key = \Config::get('maid.stripe_private_key');
                \Stripe::setApiKey($key);
                \Stripe_Charge::create(array(
                        "amount" => $amount, # amount in cents, again
                        "currency" => "usd",
                        "customer" => $customer->payment_info)
                );

                $job->status = \App\Models\Job::STATUS_PAID;
                $job->save();

            } catch(\Stripe_CardError $e) {
                return Redirect::back()->withErrors('Charging process has error!')->withInput();
            }
        }
        else{
            $job->amount = 0;
            $job->status = \App\Models\Job::STATUS_PAID;
            $job->save();
        }

        return Redirect::to('admin/job/charge')->with('success', 'Charge customer successfully!');
    }

    public function postAssignTeam()
    {
        $input = Input::all();
        $jobId = $input['job_id'];

        $job = \App\Models\Job::find($jobId);
        if(!$job){
            return Redirect::back()->withErrors('Could not find job')->withInput();
        }

        $rules = array(
            'team_id'      =>  'required|numeric|exists:team',
            'team_revenue'      =>  'required|numeric'
        );

        $validator = \Validator::make(Input::all(), $rules);
        if(!$validator->passes()){
            return Redirect::back()->withErrors($validator->messages())->withInput();
        }

        $job->team_id = Input::get('team_id');
        $job->team_revenue = Input::get('team_revenue');
        $job->status = \App\Models\Job::STATUS_ASSIGNED;
        $job->save();

        //email to team members
        $team = \App\Models\Team::find(Input::get('team_id'));
        $members = $team->members;
        foreach($members as $member){
            $receivers[] = $member->email;
        }

        $data = \App\Helpers\Job::prepareJobInfoForEmail($job);
        $data['teamName'] = $team->team_name;
        \Mail::send('emails.job-assigned', $data, function($message) use($receivers)
        {
            $companyName = \Config::get('maid.company_name');

            $message->to($receivers)->subject("[$companyName] Job Assigned!");
        });


        return Redirect::to('admin/job')->with('success', 'Job has been assigned!');
    }

    public function updateJobStatus()
    {
        $cid = Input::get('cid');
        $value = Input::get('params');

        if (empty($cid))
        {
            return Redirect::back()->withErrors(trans('No job selected'));
        }
        if(is_array($cid))
        {
            $cid = $cid[0];
        }
        $job = \App\Models\Job::find($cid);
        $job->status = $value;

        if($value == \App\Models\Job::STATUS_COMPLETED){
            $teamName = $job->team->team_name;
            $data = compact('teamName', 'job');

            $receivers = $job->customer_email;
            \Mail::send('emails.job-completed', $data, function($message) use($receivers)
            {
                $companyName = \Config::get('maid.company_name');

                $message->to($receivers)->subject("[$companyName] Job Completed!");
            });
            $msg = 'Job has been completed!';
        }

        if($value == \App\Models\Job::STATUS_PAID_TEAM){

            //send payments to each team members
            $team = $job->team;
            $members = $team->members;
            $numMembers = count($members);
            foreach($members as $member){
                $key = \Config::get('maid.stripe_private_key');
                \Stripe::setApiKey($key);

                // Create a transfer to the specified recipient
                $amount = ($job->amount + $job->giftcard_amount) * $job->team_revenue / $numMembers;
                $amount = intval($amount);
                try{
                    $transfer = \Stripe_Transfer::create(array(
                            "amount" => $amount, // amount incents
                            "currency" => "usd",
                            "recipient" => $member->recipient_id,
                            "bank_account" => $member->bank_account_id,
                            "statement_description" => "MaidSavvy Payment")
                    );
                }
                catch(\Exception $e){
                    return Redirect::back()->withErrors($e->getMessage());
                }
            }


            $msg = 'Job has been paid to each team members.';
        }

        if(!isset($msg)){
            $msg = 'Job has been updated.';
        }
        $job->save();

        return Redirect::to('admin/job')->with('success', $msg);
    }

    public function getFeedback()
    {
        Toolbar::title('Job Feedback');

        return View::make('admin.job.job-rating');
    }

    public function getPaidTeamJobs()
    {
        Toolbar::title('Completed Jobs');

        return View::make('admin.job.job-paid-team');
    }

    public function getFrequencyJobs()
    {
        Toolbar::title('Frequency Jobs');

        return View::make('admin.job.job-frequency');
    }

    public function postFrequencyJobs()
    {
        $input = \Input::all();

        list($jobId, $pause) = explode(':',$input['params']);
        if($jobId == null){
            return Redirect::back()->withErrors('Could not find job.')->withInput();
        }
        if(!isset($pause)){
            return Redirect::back()->withErrors('Recurring param is null.')->withInput();
        }

        $job = \App\Models\Job::find($jobId);
        if(!$job){
            return Redirect::back()->withErrors('Could not find job.')->withInput();
        }

        $job->recurring_pause = $pause;
        $job->save();

        return Redirect::to('admin/job/frequency-jobs');
    }

    public function postRecurringJob()
    {
        $input = Input::all();
        $jobId = $input['job_id'];

        $job = \App\Models\Job::find($jobId);
        if(!$job){
            return Redirect::back()->withErrors('Could not find job')->withInput();
        }

        $customer = \App\Models\Customer::find($job->customer_id);
        if(!$customer){
            return Redirect::back()->withErrors('Could not find customer of this job')->withInput();
        }

        $jobAttrs = $job->getAttributes();
        $input = array_merge($jobAttrs, $input);
        unset($input['job_id']);

        /*
        |--------------------------------------------------------------------------
        | save job
        |--------------------------------------------------------------------------
        */
        //$job = \App\Helpers\Job::saveJob($customer, $input);
        $job->setData($input);
        $job->save();

        $job->status = \App\Models\Job::STATUS_ASSIGNED;
        $job->save();

        \App\Helpers\Job::sendBookingEmail('', $job);

        return Redirect::to('admin/job')->with('success', 'Job has been created!');
    }
}