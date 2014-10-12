<?php
namespace App\Helpers;

class Job {

    protected static $errors;

    protected static function setErrors($errors)
    {
        static::$errors = $errors;
        return false;
    }

    /**
     * Retrieve error message bag
     */
    public static function getErrors()
    {
        return static::$errors;
    }

    public static function hasErrors()
    {
        return ! empty(static::$errors);
    }

    public static function bookAppointment($input)
    {
        /*
        |--------------------------------------------------------------------------
        | save customer
        |--------------------------------------------------------------------------
        */
        $customer = static::saveCustomer($input);
        if(!$customer){
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | save job
        |--------------------------------------------------------------------------
        */
        $job = static::saveJob($customer, $input);
        if(!$job){
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Make payment
        |--------------------------------------------------------------------------
        */
        static::makePayment($customer, $job, $input);

        /*
        |--------------------------------------------------------------------------
        | Send Booking Email
        |--------------------------------------------------------------------------
        */
        if(!isset($input['password']))
        {
            $input['password'] = '';
        }
        static::sendBookingEmail($input['password'], $job);


        /*
        |--------------------------------------------------------------------------
        | Login User
        |--------------------------------------------------------------------------
        */
        if(!isset($input['customer_id']) || empty($input['customer_id'])){
            \Auth::login($customer);
        }

        return true;
    }

    public static function saveCustomer(&$input)
    {
        if(isset($input['customer_id']) && !empty($input['customer_id'])){
            $customer = \App\Models\Customer::find($input['customer_id']);
            if(!$customer){
                return static::setErrors('Could not find customer');
            }
        }
        else{

            $customer = \App\Models\Customer::where('email', $input['email'])->first();
            if(!$customer){
                $customer = new \App\Models\Customer();

                $password = str_random(8);
                $customer->password = \Hash::make($password);
                $input['password'] = $password;
            }
        }

        if(!$customer->validate($input))
        {
            return static::setErrors($customer->getErrors());
        }
        $customer->setData($input);
        $customer->save();

        return $customer;
    }

    public static function saveJob($customer, $input)
    {
        $job = new \App\Models\Job();
        $input['customer_id'] = $customer->customer_id;
        $input['customer_email'] = $customer->email;
        $input['customer_phone'] = $customer->phone;
        $input['customer_name'] = $customer->first_name.' '.$customer->last_name;
        if(!$job->validate($input))
        {
            if(!isset($input['job_id']) || empty($input['job_id'])){//case: add new
                $customer->delete();
            }
            return static::setErrors($job->getErrors());
        }
        $job->setData($input);
        $job->save();
        return $job;
    }

    private static function makePayment($customer, $job, $input)
    {
        if(isset($input['stripeToken']))
        {
            $token = $input['stripeToken'];
            $key = \Config::get('maid.stripe_private_key');
            \Stripe::setApiKey($key);
            try {
                // Create or Update a Stripe Customer
                if(isset($customer->payment_info)){
                    $stripeCustomer = \Stripe_Customer::retrieve($customer->payment_info);
                    $stripeCustomer->card = $token; // obtained with Stripe.js
                    $stripeCustomer->save();
                }
                else{
                    $stripeCustomer = \Stripe_Customer::create(array(
                            "card" => $token,
                            "description" => $input['email'])
                    );
                    $customer->payment_info = $stripeCustomer->id;
                    $customer->save();
                }

                $job->status = \App\Models\Job::STATUS_CARD_APPROVED;
                $job->payment_info = $stripeCustomer->id;
            } catch(\Stripe_CardError $e) {
                $job->status = \App\Models\Job::STATUS_CARD_DENIED;
            }
            $job->save();
        }
    }

    private static function sendBookingEmail($password, $job)
    {
        $data = static::prepareJobInfoForEmail($job);
        $data['password'] = $password;

        $recipient = $job->customer_email;
        \Mail::send('emails.booking', $data, function($message) use($recipient)
        {
            $adminEmail = \Config::get('maid.admin_email');
            $companyName = \Config::get('maid.company_name');

            $message->to($recipient)->subject("[$companyName] Welcome!")->cc($adminEmail);
        });
    }

    public static function prepareJobInfoForEmail($job)
    {
        $companyName = \Config::get('maid.company_name');

        $serviceType = \App\Models\ServiceType::find($job->service_type);
        $serviceTypeName = $serviceType->st_name;
        $serviceTypePrice = $serviceType->st_price;

        $serviceFreq = \App\Models\ServiceFrequency::find($job->service_frequency);
        $frequency = $serviceFreq->sf_name;
        $frequency_int = $serviceFreq->sf_id;
        $frequencyDiscount = $serviceFreq->sf_discount;
        $amountBeforeDiscount = ($job->amount + $job->giftcard_amount) / ( 1 - ($frequencyDiscount/100));

        $seList = $job->getServiceExtrasText();

        $data = compact('companyName', 'job', 'serviceTypeName', 'serviceTypePrice', 'frequency', 'seList', 'amountBeforeDiscount','frequency_int');

        return $data;
    }

    public static function sendAssignedJobsToTeam($team)
    {
        if(is_numeric($team)){
            $team = \App\Models\Team::find($team);
        }

        if(!$team){
            return false;
        }

        $members = $team->members()->get();
        if(!$members){
            return false;
        }

        //find assigned jobs of team
        $jobs = $team->jobs()->whereRaw('take_time > NOW()')->where('status', \App\Models\Job::STATUS_ASSIGNED)->get();
        if(count($jobs) > 0){
            $data['jobs'] = $jobs;
            
            foreach($members as $member){
                $receivers[] = $member->email;
            }

            \Mail::send('emails.team-schedule', $data, function($message) use($receivers)
            {
                $companyName = \Config::get('maid.company_name');
                $message->to($receivers)->subject('['.$companyName.'] Team Schedule!');
            });
            return true;
        }
        return false;
    }


    public static function calculateAmount($serviceType, $serviceFrequency, $serviceExtras)
    {
        $serviceType = \App\Models\ServiceType::find($serviceType);
        $amount = $serviceType->st_price;

        if(isset($serviceExtras) && !empty($serviceExtras)){
            if(is_string($serviceExtras)){
                $serviceExtras = explode(",", $serviceExtras);
            }
            foreach($serviceExtras as $se){
                $se = \App\Models\ServiceExtra::find($se);
                $amount += $se->se_price;
            }
        }

        $serviceFrequency = \App\Models\ServiceFrequency::find($serviceFrequency);
        $amount = $amount - $amount*$serviceFrequency->sf_discount/100;

        return $amount;
    }

    public static function applyDiscountCode($amount, $discountCode)
    {
        if(isset($discountCode) && !empty($discountCode)){

            $giftcard = \App\Models\GiftCard::where('discount_code', $discountCode)->first();
            if(!$giftcard){
                return false;
            }
            $giftBalance =  $giftcard->balance;
            if($amount > $giftBalance){
                $giftAmountUsed = $giftBalance;
            }
            else{
                $giftAmountUsed = $amount;
            }
            if(empty($giftcard->unlimited)){
                $giftcard->balance = $giftBalance - $giftAmountUsed;
                $giftcard->save();
            }

            return $giftAmountUsed;
        }
    }

    public static function createJobFrequency()
    {
//        $results = \DB::select('select * from job as j1 where j1.status in (?,?,?,?) and j1.recurringjob = 0
//                            and j1.recurring_pause = 0
//                            and exists (
//                                select 1 from customer where j1.customer_id = customer.customer_id and customer.service_frequency >= 2
//                            )', array(\App\Models\Job::STATUS_COMPLETED, \App\Models\Job::STATUS_PAID, \App\Models\Job::STATUS_PAID_TEAM, \App\Models\Job::STATUS_CANCELED));

        $results = \DB::select('select * from job as j1 where j1.status in (?,?,?,?) and j1.recurringjob = 0
                            and j1.recurring_pause = 0
                            and j1.service_frequency >= 2', array(\App\Models\Job::STATUS_COMPLETED, \App\Models\Job::STATUS_PAID, \App\Models\Job::STATUS_PAID_TEAM, \App\Models\Job::STATUS_CANCELED));

        foreach($results as $jobArr){
            $job = new \App\Models\Job();
            $job->customer_id = $jobArr->customer_id;
            $job->customer_email = $jobArr->customer_email;
            $job->customer_phone = $jobArr->customer_phone;
            $job->customer_name = $jobArr->customer_name;
            $job->team_id = $jobArr->team_id;
            $job->team_revenue = $jobArr->team_revenue;
            $job->discount_code = $jobArr->discount_code;
            $job->take_time = $jobArr->take_time;

            //load services from customer
            $customer = \App\Models\Customer::find($jobArr->customer_id);
            if(!$customer){
                \App\Models\Job::destroy($jobArr->job_id);
                continue;
            }
            $job->payment_info = $jobArr->payment_info;
            $job->address = $jobArr->address;
            $job->city = $jobArr->city;
            $job->state = $jobArr->state;
            $job->zipcode = $jobArr->zipcode;
            $job->service_type = $jobArr->service_type;
            $job->service_frequency = $jobArr->service_frequency;
            $job->service_extras = $jobArr->service_extras;

            //total amount
            $amount = \App\Helpers\Job::calculateAmount($job->service_type, $job->service_frequency, $job->service_extras);

            //giftcard
            if(isset($job->discount_code) && !empty($job->discount_code)){
                //if girtcard is coupon code, do not apply
                $giftcard = \App\Models\GiftCard::where('discount_code', $job->discount_code)->first();
                if(empty($giftcard->unlimited))
                {
                    $giftcardAmount = \App\Helpers\Job::applyDiscountCode($amount, $job->discount_code);
                    if(!$giftcardAmount){
                        $job->discount_code = null;
                    }
                    else{
                        $job->giftcard_amount = $giftcardAmount;
                        $amount = $amount - $giftcardAmount;
                    }
                }
                else{
                    $job->discount_code = null;
                }
            }
            $job->amount = $amount;

            //take time
            $modify = '';
            switch($job->service_frequency){
                case 2: {
                    $weekDiff = \App\Helpers\Job::datediff('ww', $job->take_time, date('Y-m-d H:i:s'));
                    $weekDiff += 1;
                    $modify = '+'.$weekDiff.' week';
                    break;
                }
                case 3: {
                    $weekDiff = \App\Helpers\Job::datediff('ww', $job->take_time, date('Y-m-d H:i:s'));
                    $weekDiff += 2;
                    $modify = '+' . $weekDiff . ' week';
                    break;
                }
                case 4:
                    $monthDiff = \App\Helpers\Job::datediff('m', $job->take_time, date('Y-m-d H:i:s'));
                    $monthDiff += 1;
                    $modify = '+'.$monthDiff.' month';
                    break;
            }
            $takeTime = strtotime($modify, strtotime($job->take_time));

            $job->take_time = date('Y-m-d H:i:s', $takeTime);

            $job->status = \App\Models\Job::STATUS_ASSIGNED;

            $job->rating = null;
            $job->comment = null;
            $job->save();


            \App\Models\Job::where('job_id',  $jobArr->job_id)->update(array('recurringjob' => 1));
        }
    }

    public static function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
    {
        /*
        $interval can be:
        yyyy - Number of full years
        q - Number of full quarters
        m - Number of full months
        y - Difference between day numbers
            (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
        d - Number of full days
        w - Number of full weekdays
        ww - Number of full weeks
        h - Number of full hours
        n - Number of full minutes
        s - Number of full seconds (default)
        */

        if (!$using_timestamps) {
            $datefrom = strtotime($datefrom, 0);
            $dateto = strtotime($dateto, 0);
        }
        $difference = $dateto - $datefrom; // Difference in seconds
        $months_difference = 0;

        switch($interval) {

            case 'yyyy': // Number of full years
                $years_difference = floor($difference / 31536000);
                if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
                    $years_difference--;
                }
                if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
                    $years_difference++;
                }
                $datediff = $years_difference;
                break;
            case "q": // Number of full quarters
                $quarters_difference = floor($difference / 8035200);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }
                $quarters_difference--;
                $datediff = $quarters_difference;
                break;
            case "m": // Number of full months
                $months_difference = floor($difference / 2678400);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }
                $months_difference--;
                $datediff = $months_difference;
                break;
            case 'y': // Difference between day numbers
                $datediff = date("z", $dateto) - date("z", $datefrom);
                break;
            case "d": // Number of full days
                $datediff = floor($difference / 86400);
                break;
            case "w": // Number of full weekdays
                $days_difference = floor($difference / 86400);
                $weeks_difference = floor($days_difference / 7); // Complete weeks
                $first_day = date("w", $datefrom);
                $days_remainder = floor($days_difference % 7);
                $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
                if ($odd_days > 7) { // Sunday
                    $days_remainder--;
                }
                if ($odd_days > 6) { // Saturday
                    $days_remainder--;
                }
                $datediff = ($weeks_difference * 5) + $days_remainder;
                break;
            case "ww": // Number of full weeks
                $datediff = floor($difference / 604800);
                break;
            case "h": // Number of full hours
                $datediff = floor($difference / 3600);
                break;
            case "n": // Number of full minutes
                $datediff = floor($difference / 60);
                break;
            default: // Number of full seconds (default)
                $datediff = $difference;
                break;
        }
        return $datediff;
    }
}