<?php
namespace App\Controllers;

use BaseController, Input, Auth, Session, Redirect, View, Hash, Validator, Mail;

class CronController extends BaseController {

    public function getEmailCustomerTomorrowJobDaily()
    {
        //find all tomorrow job
        $nowDate = strtotime(date('Y-m-d'));
        $tomorrow = strtotime('+1 day', $nowDate);
        $tomorrowDate = date('Y-m-d', $tomorrow);

        $jobs = \App\Models\Job::where('take_time','LIKE',"$tomorrowDate%")
            ->whereIn('status', array(\App\Models\Job::STATUS_ASSIGNED, \App\Models\Job::STATUS_CARD_APPROVED))->get();

        //send email to customer
        foreach($jobs as $job){

            $data = \App\Helpers\Job::prepareJobInfoForEmail($job);

            $recipient = $job->customer_email;
            \Mail::send('emails.job-scheduled', $data, function($message) use($recipient)
            {
                $companyName = \Config::get('maid.company_name');

                $message->to($recipient)->subject("[$companyName] Job Scheduled!");
            });
        }

    }

    public function getEmailTeamJobDaily()
    {
        $teams = \App\Models\Team::all();

        //send email to team members
        foreach($teams as $team){
            \App\Helpers\Job::sendAssignedJobsToTeam($team);
        }
    }

    public function getRecurringJobWeekly()
    {
        \App\Helpers\Job::createJobFrequency();
    }

}