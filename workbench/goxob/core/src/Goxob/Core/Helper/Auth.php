<?php
namespace Goxob\Core\Helper;

use Session, Hash;

class Auth {

    public static function user()
    {
        return Session::get('admin.auth');
    }

    public static function logout()
    {
        Session::forget('admin.auth');
    }

    public static function check()
    {
        if(Session::has('admin.auth'))
        {
            return true;
        }
        return false;
    }

    public static function attempt($credentials)
    {
        $username = $credentials['username'];
        $password = $credentials['password'];

        $user = new \App\Models\User();
        if($user->checkLogin($username, $password))
        {
            if (isset($user) && Hash::needsRehash($user->password))
            {
                $hashed = Hash::make($password);
                $user->password = $hashed;
            }

            Session::put('admin.auth', $user);
            return true;
        }
        return false;
    }
}