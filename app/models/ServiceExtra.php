<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 9/17/14
 * Time: 11:19 AM
 * To change this template use File | Settings | File Templates.
 */

namespace App\Models;


class ServiceExtra extends \Goxob\Core\Model\Model{

    protected $table = 'service_extras';
    protected $primaryKey = 'se_id';

    public $timestamps = false;

    protected $fillable = array( 'se_name', 'se_price' );

    public static $rules = array(
        'se_name'=>'required|min:2',
    );


}