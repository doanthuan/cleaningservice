<?php
namespace App\Models;

use Hash, View;

class Team extends \Goxob\Core\Model\Model{

    protected $table = 'team';
    protected $primaryKey = 'team_id';

    public $timestamps = false;

    protected $fillable = array( 'team_name' );

    public static $rules = array(
        'team_name'=>'required|min:2',
    );

    public function jobs()
    {
        return $this->hasMany('\App\Models\Job', 'team_id', 'team_id');
    }

    public function members()
    {
        return $this->hasMany('\App\Models\User', 'team_id', 'team_id');
    }

}