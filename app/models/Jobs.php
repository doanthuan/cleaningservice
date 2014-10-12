<?php
namespace App\Models;

use DB;
class Jobs extends \Goxob\Core\Model\ModelList{

    protected $defaultJoins = array('team');

//    protected function joinCustomer()
//    {
//        $this->query->addSelect('customer.email as customer_email');
//        $this->query->addSelect('customer.phone as customer_phone');
//        $this->query->leftJoin('customer', 'job.customer_id', '=', 'customer.customer_id' );
//    }

    protected function joinTeam()
    {
        $this->query->addSelect(\DB::raw('CONCAT(team.team_name, \' - \', job.team_revenue, \'%\') as team_name'));
        $this->query->leftJoin('team', 'job.team_id', '=', 'team.team_id' );
    }

}