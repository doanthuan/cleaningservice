<?php
namespace App\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Model;

class Customer extends Model implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

    const STATUS_PENDING = 1;
    const STATUS_VERIFIED = 2;
    const STATUS_BANNED = 3;
    const STATUS_DELETED = 4;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer';

    protected $primaryKey = 'customer_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    protected $fillable = array('first_name', 'last_name', 'email', 'phone', 'payment_info',
        'address', 'city', 'state', 'zipcode', 'service_type', 'take_time', 'service_frequency', 'service_extras'
    );

    public static $rules = array(
        'first_name'=>'required|min:2',
        'last_name'=>'required|min:2',
        //'email'=> 'email|unique:customer,email,:id,customer_id',
        'email'=> 'email',
        'address'=>'required',
        'city'=>'required',
        'state'=>'required',
        'zipcode'=>'required',
    );

    public function setData($input)
    {
        parent::setData($input);

        $this->status = static::STATUS_VERIFIED;

        //take time
        if(isset($input['take_time'])){
            $date = \DateTime::createFromFormat('m/d/Y h:i A', $input['take_time']);
            if(!$date){
                $date = \DateTime::createFromFormat('Y-m-d h:i:s', $input['take_time']);
            }
            $this->take_time = $date->format('Y-m-d h:i:s');
        }

        //service_extras
        if(isset($input['service_extras']) && !empty($input['service_extras']))
        {
            $service_extras = array();
            foreach($input['service_extras'] as $extra){
                $service_extras[] = $extra;
            }
            $this->service_extras = implode(',',$service_extras);
        }
        else{
            $this->service_extras = '';
        }


    }

    public function validate($input)
    {
        if(parent::validate($input))
        {
            if(isset($input['take_time'])){
                $date = \DateTime::createFromFormat('m/d/Y h:i A', $input['take_time']);
                if(!$date){
                    $date = \DateTime::createFromFormat('Y-m-d h:i:s', $input['take_time']);
                    if(!$date){
                        return $this->setErrors('Date time picker is invalid format');
                    }
                }
            }
            return true;
        }
        return false;
    }

    //relationship
    public function jobs()
    {
        return $this->hasMany('\App\Models\Job', 'customer_id', 'customer_id');
    }
}
