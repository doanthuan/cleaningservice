<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 9/17/14
 * Time: 11:19 AM
 * To change this template use File | Settings | File Templates.
 */

namespace App\Models;


class ZipCode extends \Goxob\Core\Model\Model{

    protected $table = 'zipcode';
    protected $primaryKey = 'zipcode_id';

    public $timestamps = false;

    protected $fillable = array( 'zipcode');

    public static $rules = array(
        'zipcode'=>'required|min:2',
    );
}