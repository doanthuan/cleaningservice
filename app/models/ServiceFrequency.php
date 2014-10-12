<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 9/17/14
 * Time: 11:19 AM
 * To change this template use File | Settings | File Templates.
 */

namespace App\Models;


class ServiceFrequency extends \Goxob\Core\Model\Model{

    protected $table = 'service_frequency';
    protected $primaryKey = 'sf_id';

    public $timestamps = false;

    protected $fillable = array( 'sf_name', 'sf_discount' );

    public static $rules = array(
        'sf_name'=>'required|min:2',
    );


}