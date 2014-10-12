<?php
namespace App\Helpers;

class GiftCard {

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

    public static function purchase($input)
    {
        /*
        |--------------------------------------------------------------------------
        | save giftcard
        |--------------------------------------------------------------------------
        */
        $giftcard = static::saveGiftCard($input);
        if(!$giftcard){
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Make payment
        |--------------------------------------------------------------------------
        */
        if(!static::makePayment($input)){
            $giftcard->delete();
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Send Email
        |--------------------------------------------------------------------------
        */
        static::sendPurchaseEmail($giftcard);

        return true;
    }

    public static function saveGiftCard(&$input)
    {
        $giftcard = new \App\Models\GiftCard();

        if(!$giftcard->validate($input))
        {
            return static::setErrors($giftcard->getErrors());
        }
        $giftcard->setData($input);
        $giftcard->discount_code = str_random(8);
        $giftcard->balance = $input['gift_amount'];
        $giftcard->save();

        return $giftcard;
    }

    private static function makePayment($input)
    {
        if(isset($input['stripeToken']))
        {
            $key = \Config::get('maid.stripe_private_key');
            \Stripe::setApiKey($key);
            $token = $input['stripeToken'];
            $amount = floatval($input['gift_amount']) * 100;
            $description = 'Purchase MaidSavvy gift card from '.$input['from_email'];
            try {
                $charge = \Stripe_Charge::create(array(
                        "amount" => $amount, // amount in cents, again
                        "currency" => "usd",
                        "card" => $token,
                        "description" => $description)
                );
                return true;
            } catch(\Stripe_CardError $e) {
                // The card has been declined
                return static::setErrors($e->getMessage());
            }
        }
    }

    private static function sendPurchaseEmail($giftcard)
    {
        $receivers = array($giftcard->to_email, $giftcard->from_email);

        $data['giftcard'] = $giftcard;
        \Mail::send('emails.giftcard', $data, function($message) use($receivers)
        {
            $adminEmail = \Config::get('maid.admin_email');
            $companyName = \Config::get('maid.company_name');

            $message->to($receivers)->subject("[$companyName] Purchase Gift Card!")->cc($adminEmail);
        });
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
}