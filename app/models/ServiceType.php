<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 9/17/14
 * Time: 11:19 AM
 * To change this template use File | Settings | File Templates.
 */

namespace App\Models;


class ServiceType extends \Goxob\Core\Model\Model{

    protected $table = 'service_type';
    protected $primaryKey = 'st_id';

    public $timestamps = false;

    protected $fillable = array( 'st_name', 'st_price' );

    public static $rules = array(
        'st_name'=>'required|min:2',
    );
}