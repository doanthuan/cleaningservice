<?php
namespace App\Models;

use Model;

class Job extends Model{

    const STATUS_CREATED = 1;
    const STATUS_CARD_APPROVED = 2;
    const STATUS_CARD_DENIED = 3;
    const STATUS_ASSIGNED = 4;
    const STATUS_COMPLETED = 5;
    const STATUS_PAID = 6;
    const STATUS_CANCELED = 7;
    const STATUS_PAID_TEAM = 8;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'job';

    protected $primaryKey = 'job_id';

    protected $fillable = array('amount', 'customer_id', 'customer_email', 'customer_phone', 'customer_name', 'team_id',
        'team_revenue',  'discount_code',  'giftcard_amount', 'payment_info', 'address', 'city', 'state', 'zipcode',
        'service_type', 'take_time', 'service_frequency', 'service_extras', 'rating', 'comment',
        'feedback_phone', 'feedback_email'
    );

    public static $rules = array(
        'customer_id'=>'required',
        'amount'=>'required|numeric',
        'address'=>'required',
        'city'=>'required',
        'state'=>'required',
        'zipcode'=>'required',
    );

    public function getTakeTimeAttribute($value)
    {
        if(is_object($value))
            return $value;

        if(!empty($value)){
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $value);
            if(!$date){
                $date = \DateTime::createFromFormat('Y-m-d H:i', $value);
            }
            if($date){
                return $date->format('m/d/Y h:i A');
            }
            return $value;
        }
    }


    public function setData($input)
    {
        parent::setData($input);

        if(!isset($this->status)){
            $this->status = static::STATUS_CREATED;
        }

        //take time
        if(isset($input['take_time'])){
            $date = \DateTime::createFromFormat('m/d/Y h:i A', $input['take_time']);
            if(!$date){
                $date = \DateTime::createFromFormat('Y-m-d h:i:s', $input['take_time']);
            }
            $this->take_time = $date->format('Y-m-d h:i:s');
        }

        //service_extras
        if(!empty($input['service_extras']) && is_array($input['service_extras'])){
            $service_extras = array();
            foreach($input['service_extras'] as $extra){
                $service_extras[] = $extra;
            }
            $this->service_extras = implode(',',$service_extras);
        }
        elseif(!empty($input['service_extras'])){
            $this->service_extras = $input['service_extras'];
        }

        //total amount
        if(isset($input['service_type']) && isset($input['service_frequency']))
        {
            if(!isset($input['service_extras'])){
                $input['service_extras'] = null;
            }
            $amount = \App\Helpers\Job::calculateAmount($input['service_type'], $input['service_frequency'], $input['service_extras']);

            //giftcard
            if(isset($input['discount_code']) && !empty($input['discount_code'])){
                $giftcardAmount = \App\Helpers\Job::applyDiscountCode($amount, $input['discount_code']);
                $this->giftcard_amount = $giftcardAmount;

                $amount = $amount - $giftcardAmount;
            }
            $this->amount = $amount;
        }



    }

    public function validate($input)
    {
        if(parent::validate($input))
        {
            if(isset($input['take_time'])){
                $date = \DateTime::createFromFormat('m/d/Y h:i A', $input['take_time']);
                if(!$date){
                    $date = \DateTime::createFromFormat('m/d/Y h:i:s', $input['take_time']);
                    if(!$date){
                        return $this->setErrors('Date time picker is invalid format');
                    }
                }
            }
            if(isset($input['discount_code']) && !empty($input['discount_code'])){
                $giftcard = \App\Models\GiftCard::where('discount_code', $input['discount_code'])->first();
                if(!$giftcard){
                    return $this->setErrors('Discount code is invalid');
                }
//                if($giftcard->balance <= 0){
//                    return $this->setErrors('This discount code has no credits');
//                }
            }
            return true;
        }
        return false;
    }

    public function customer()
    {
        return $this->belongsTo('\App\Models\Customer','customer_id', 'customer_id');
    }

    public function team()
    {
        return $this->belongsTo('\App\Models\Team','team_id', 'team_id');
    }

    public function serviceType()
    {
        return $this->belongsTo('\App\Models\ServiceType','service_type', 'st_id');
    }

    public function serviceFrequency()
    {
        return $this->belongsTo('\App\Models\ServiceFrequency','service_frequency', 'sf_id');
    }

    public static function getStatusString($status)
    {
        switch($status)
        {
            case static::STATUS_CREATED:
                return 'Created';
            case static::STATUS_CARD_APPROVED:
                return 'Card Approved';
            case static::STATUS_CARD_DENIED:
                return 'Card Denied';
            case static::STATUS_ASSIGNED:
                return 'Assigned';
            case static::STATUS_COMPLETED:
                return 'Completed';
            case static::STATUS_PAID:
                return 'Paid';
            case static::STATUS_CANCELED:
                return 'Canceled';
            case static::STATUS_PAID_TEAM:
                return 'Paid to Team';
        }
    }

    public static function getStatusStringForCustomer($status)
    {
        switch($status)
        {
            case static::STATUS_CREATED:
                return 'Created';
            case static::STATUS_CARD_APPROVED:
                return 'Card Approved';
            case static::STATUS_CARD_DENIED:
                return 'Card Denied';
            case static::STATUS_ASSIGNED:
                return 'Up Coming';
            case static::STATUS_COMPLETED:
                return 'Completed';
            case static::STATUS_PAID:
                return 'Completed';
            case static::STATUS_CANCELED:
                return 'Canceled';
            case static::STATUS_PAID_TEAM:
                return 'Completed';
        }
    }

    public static function getStatusList()
    {
        $list = array();
        for($i = 1; $i <= 8; $i++){
            $list[$i] = static::getStatusString($i);
        }
        return $list;
    }

    public static function getCompletedStatusList()
    {
        $list = array();
        $list[static::STATUS_COMPLETED] = static::getStatusString(static::STATUS_COMPLETED);
        $list[static::STATUS_PAID] = static::getStatusString(static::STATUS_PAID);
        $list[static::STATUS_PAID_TEAM] = static::getStatusString(static::STATUS_PAID_TEAM);

        return $list;
    }

    public function getServiceExtrasText()
    {
        if(isset($this->service_extras) && !empty($this->service_extras)){
            $serviceExtras = explode(",", $this->service_extras);
            $serviceExtras = \App\Models\ServiceExtra::whereIn('se_id', $serviceExtras)->get();
            if($serviceExtras){
                foreach($serviceExtras as $se){
                    $seList[] = $se->se_name ;
                }
                $seList = implode(", ", $seList);
                return $seList;
            }
            return '';
        }
        return '';
    }
}
