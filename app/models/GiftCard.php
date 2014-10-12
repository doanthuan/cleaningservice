<?php
namespace App\Models;

use Hash, View;

class GiftCard extends \Goxob\Core\Model\Model{

    protected $table = 'giftcard';
    protected $primaryKey = 'giftcard_id';

    protected $fillable = array( 'gift_amount', 'to_name', 'to_email', 'from_name', 'from_email', 'message' );

    public static $rules = array(
        'gift_amount'=>'required|numeric',
        'to_name'=>'required',
        'to_email'=>'required',
        'from_name'=>'required',
        'from_email'=>'required',
        'message'=>'required',
    );

}