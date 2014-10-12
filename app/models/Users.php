<?php
namespace App\Models;


class Users extends \Goxob\Core\Model\ModelList{

    protected $defaultJoins = array('team');

    protected function joinTeam()
    {
        $this->query->addSelect('team_name');
        $this->query->leftJoin('team', 'user.team_id', '=', 'team.team_id' );
    }

}