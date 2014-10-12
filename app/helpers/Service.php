<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 9/17/14
 * Time: 11:54 AM
 * To change this template use File | Settings | File Templates.
 */

namespace App\Helpers;


class Service {
    public static function getBookingServices()
    {
        $allServiceType = \App\Models\ServiceType::all();
        foreach($allServiceType as $st){
            $key = $st->st_id.':'. intval($st->st_price);
            $stList[$key]= $st->st_name;
        }

        $allServiceExtras = \App\Models\ServiceExtra::all();
        foreach($allServiceExtras as $se){
            $key = $se->se_id.':'. intval($se->se_price);
            $seList[$key]= $se->se_name;
        }

        return array($stList, $seList);
    }
}