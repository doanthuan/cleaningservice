<?php
namespace App\Controllers\Admin;

use Auth, Session, Redirect, View, Input;

use \Goxob\Core\Html\Toolbar;

class TeamController extends \Goxob\Core\Controller\AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\Models\Team();
    }

    public function anyIndex()
    {
        Toolbar::title('Manage Teams');
        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 1){
            Toolbar::buttons(array(Toolbar::BUTTON_CREATE, Toolbar::BUTTON_DELETE)) ;
        }

        Toolbar::clickButton('Send Schedule', 'sendSchedule()');

        return View::make('admin.team.index');
    }

    public function sendSchedule()
    {
        $cid = Input::get('cid');

        if (empty($cid))
        {
            return Redirect::back()->withErrors(trans('No team selected'));
        }
        if(!is_array($cid))
        {
            $cid = array($cid);
        }
        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 1){
            foreach($cid as $teamId)
            {
                \App\Helpers\Job::sendAssignedJobsToTeam($teamId);
            }
        }
        else{
            $teamId =  $user->team_id;
            if($teamId) {
                \App\Helpers\Job::sendAssignedJobsToTeam($teamId);
            }
        }



        return Redirect::to('admin/team')->with('success', 'Team schedule was sent!');
    }

}