<?php
namespace App\Controllers\Admin;

use Auth, Session, Redirect, View, Input;

use \Goxob\Core\Html\Toolbar;

class DashboardController extends \Goxob\Core\Controller\AdminBaseController {

    public function anyIndex()
    {
        Toolbar::title(trans('Dashboard'));

        return View::make('admin.dashboard.index');
    }

    public function getTeam()
    {
        Toolbar::title(trans('Team Dashboard'));

        return View::make('admin.dashboard.team');
    }

    public function getLoadChartSalesData($range)
    {
        //day, month, year
        if(!empty($range))
        {
            $initData = $this->initChartData($range);

            $jobs = new \App\Models\Jobs();
            $jobAmount = $jobs->countInDateRange($range, null, 'sum(amount)');
            $jobAmount = $this->mergeArray($initData, $jobAmount);

            $query = $jobs->getSelect()->whereIn('status', array(\App\Models\Job::STATUS_COMPLETED, \App\Models\Job::STATUS_PAID, \App\Models\Job::STATUS_PAID_TEAM));
            $jobAmountCompleted = $jobs->countInDateRange($range, null, 'sum(amount)', $query);
            $jobAmountCompleted = $this->mergeArray($initData, $jobAmountCompleted);

            $query = $jobs->getSelect()->whereIn('status', array(\App\Models\Job::STATUS_COMPLETED, \App\Models\Job::STATUS_PAID, \App\Models\Job::STATUS_PAID_TEAM));
            $jobAmountCompletedNet = $jobs->countInDateRange($range, null, 'sum( (amount + giftcard_amount) - (amount + giftcard_amount) * team_revenue / 100)', $query);
            $jobAmountCompletedNet = $this->mergeArray($initData, $jobAmountCompletedNet);

            $resJobAmount = array();
            $resJobAmount['label'] = "Sales Amount";
            $resJobAmount['data'] = array_values($jobAmount);

            $resJobAmountCompleted = array();
            $resJobAmountCompleted['label'] = "Total Charged";
            $resJobAmountCompleted['data'] = array_values($jobAmountCompleted);

            $resJobAmountCompletedNet = array();
            $resJobAmountCompletedNet['label'] = "Net Profit";
            $resJobAmountCompletedNet['data'] = array_values($jobAmountCompletedNet);

            $result = array();
            $result[] = $resJobAmount;
            $result[] = $resJobAmountCompleted;
            $result[] = $resJobAmountCompletedNet;

            return \Response::json($result);
        }
    }

    public function getLoadChartSalesTeamData($range)
    {
        //day, month, year
        if(!empty($range))
        {
            $initData = $this->initChartData($range);

            $user = \Goxob\Core\Helper\Auth::user();
            $teamId = $user->team_id;

            $jobs = new \App\Models\Jobs();
            $query = $jobs->getSelect()->where('job.team_id', $teamId)
                ->whereIn('status', array(\App\Models\Job::STATUS_PAID_TEAM));

            $jobAmountEarn = $jobs->countInDateRange($range, null, 'sum( (amount + giftcard_amount) * team_revenue / 100)', $query);
            $jobAmountEarn = $this->mergeArray($initData, $jobAmountEarn);

            $resJobAmount = array();
            $resJobAmount['label'] = "Earn Amount";
            $resJobAmount['data'] = array_values($jobAmountEarn);

            $result = array();
            $result[] = $resJobAmount;

            return \Response::json($result);
        }
    }

    public function getLoadChartSalesTeamsData($range)
    {
        //day, month, year
        if(!empty($range))
        {
            $teams = \App\Models\Team::all();
            $result = array();

            foreach($teams as $team){
                $initData = $this->initChartData($range);

                $teamId = $team->team_id;

                $jobs = new \App\Models\Jobs();
                $query = $jobs->getSelect()->where('job.team_id', $teamId)
                    ->whereIn('status', array(\App\Models\Job::STATUS_PAID_TEAM));

                $jobAmountEarn = $jobs->countInDateRange($range, null, 'sum( (amount + giftcard_amount) * team_revenue / 100)', $query);
                $jobAmountEarn = $this->mergeArray($initData, $jobAmountEarn);

                $resJobAmount = array();
                $resJobAmount['label'] = $team->team_name;
                $resJobAmount['data'] = array_values($jobAmountEarn);

                $result[] = $resJobAmount;
            }


            return \Response::json($result);
        }
    }

    public function getLoadChartJobsData($range)
    {
        //day, month, year
        if(!empty($range))
        {
            $initData = $this->initChartData($range);

            $jobs = new \App\Models\Jobs();
            $jobData = $jobs->countInDateRange($range);
            $jobData = $this->mergeArray($initData, $jobData);

            $query = $jobs->getSelect()->whereIn('status', array(\App\Models\Job::STATUS_COMPLETED, \App\Models\Job::STATUS_PAID, \App\Models\Job::STATUS_PAID_TEAM));
            $completedJobData = $jobs->countInDateRange($range, null, null, $query);
            $completedJobData = $this->mergeArray($initData, $completedJobData);

            $query = $jobs->getSelect()->where('service_frequency', '>=', 2);
            $freJobData = $jobs->countInDateRange($range, null, null, $query);
            $freJobData = $this->mergeArray($initData, $freJobData);

            $resJobs = array();
            $resJobs['label'] = "Booking";
            $resJobs['data'] = array_values($jobData);

            $resJobsCompleted = array();
            $resJobsCompleted['label'] = "Jobs Completed";
            $resJobsCompleted['data'] = array_values($completedJobData);

            $resFreJobs = array();
            $resFreJobs['label'] = "Frequency Jobs";
            $resFreJobs['data'] = array_values($freJobData);

            $result = array();
            $result[] = $resJobs;
            $result[] = $resJobsCompleted;
            $result[] = $resFreJobs;

            return \Response::json($result);
        }
    }

    public function getLoadChartRatingData($range)
    {
        //day, month, year
        if(!empty($range))
        {
            $initData = $this->initChartData($range);

            $jobs = new \App\Models\Jobs();
            $jobData = $jobs->countInDateRange($range, null, 'count(rating)');
            $jobData = $this->mergeArray($initData, $jobData);

            $resJobs = array();
            $resJobs['label'] = "Ratings";
            $resJobs['data'] = array_values($jobData);

            $result = array();
            $result[] = $resJobs;

            return \Response::json($result);
        }
    }

    public function getLoadChartCouponData($range)
    {
        //day, month, year
        if(!empty($range))
        {
            $initData = $this->initChartData($range);

            $jobs = new \App\Models\Jobs();
            $query = $jobs->getSelect()->where('discount_code','!=','');
            $jobData = $jobs->countInDateRange($range, null, null, $query);
            $jobData = $this->mergeArray($initData, $jobData);

            $resJobs = array();
            $resJobs['label'] = "Coupons";
            $resJobs['data'] = array_values($jobData);

            $result = array();
            $result[] = $resJobs;

            return \Response::json($result);
        }
    }

    private function initChartData($range)
    {
        //init empty data
        if($range == 'day'){
            for($i = 0; $i < 24; $i++){
                $initData[$i] = array($i, 0);
            }
        }
        else if($range == 'month'){
            $days = date("t");
            for($i = 1; $i <= $days; $i++){
                $initData[$i] = array($i, 0);
            }
        }
        else if($range == 'year'){
            for($i = 1; $i <= 12; $i++){
                $initData[$i] = array($i, 0);
            }
        }
        else{
            throw new \Exception('Range:'.$range.' is not supported');
        }
        return $initData;
    }

    private function mergeArray($arr1, $arr2)
    {
        foreach($arr2 as $key => $value)
        {
            $arr1[$key] = $value;
        }
        return $arr1;
    }
}