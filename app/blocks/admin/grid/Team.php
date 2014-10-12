<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class Team extends Grid{

    protected $keyCol = 'team_id';

    protected function prepareCollection()
    {
        $model = new \App\Models\Teams();
        $query = $model->getSelect();

        $jobIds = \DB::table('job')->orderBy('job_id','DESC')->take(100)->lists('job_id');

        $query->addSelect(\DB::raw('avg(rating) as avg_rating'));
        $query->addSelect(\DB::raw('count(rating) as num_rating'));
        $query->leftJoin('job', function($join)
        {
            $join->on('team.team_id', '=', 'job.team_id');
        });
        //$query->whereIn('job.job_id', $jobIds);
        $query->groupBy('team.team_id');

        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 2){
            $query->where('team.team_id', $user->team_id);
        }

        $items = $this->getData($query);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'team_id',
            'header' => trans('ID'),
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'team_name',
            'header' => trans('Team Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'avg_rating',
            'header' => 'Average Rating',
            'renderer' => new \App\Blocks\Admin\Grid\Renderer\JobRatingTeam()
        ));

        $this->addColumn(array(
            'name' => 'num_rating',
            'header' => '#Rating'
        ));

    }

    public function getActionLinks($item, $i)
    {
        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 1){
            $editLink = parent::getActionLinks($item, $i);
            return $editLink;
        }
        return '';
    }


}