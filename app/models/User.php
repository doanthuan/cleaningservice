<?php
namespace App\Models;

use Hash, View;

class User extends \Goxob\Core\Model\Model{

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = array( 'role_id', 'username', 'first_name', 'last_name', 'email', 'status', 'team_id');

    public static $rules = array(
        'username'=>'required|alpha_num|min:2|unique:user,username,:id,user_id',
        'email'=>'required|email|unique:user,email,:id,user_id',
        'password'=>'required_if:user_id,null|min:8|confirmed',
        'password_confirmation'=>'required_if:user_id,null|min:8'
    );

    public function setData($input)
    {
        if(empty($input)){
            return;
        }

        if(!empty($input['password']))
        {
            $this->password = Hash::make($input['password']);
        }

        parent::setData($input);
    }


    public function checkLogin($username, $password)
    {
        $user = static::where('username', $username)->first();

        if (isset($user) && !Hash::check($password, $user->password))
        {
            return false;
        }

        if(!is_null($user))
        {
            $this->setData($user->getAttributes());
            return true;
        }
        return false;
    }
}