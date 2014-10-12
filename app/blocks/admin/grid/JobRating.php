<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class JobRating extends Job{

    public $actionCol = false;

    protected function prepareCollection()
    {
        $model = new \App\Models\Jobs();
        $query = $model->getSelect()->addSelect(\DB::raw('CONCAT(job.address, \' \', job.city, \' \', job.state) as job_address'));

        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 2){
            $query->where('job.team_id', $user->team_id);
        }
        $query->whereIn('job.status', array(\App\Models\Job::STATUS_COMPLETED, \App\Models\Job::STATUS_PAID,
            \App\Models\Job::STATUS_PAID_TEAM));

        $items = $this->getData($query);

        return $items;
    }


    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'take_time',
            'header' => trans('Time'),
            'class' => 'col-sm-1',
            'filter_type' => 'date_range',
            'filter_index' => 'take_time',
            'options' => array('All' => 'All', 'day' => 'Today', 'week' => 'This Week', 'month' => 'This Month')
        ));

        $this->addColumn(array(
            'name' => 'job_address',
            'header' => trans('Address'),
            'renderer' => new \App\Blocks\Admin\Grid\Renderer\JobAddress(),
            'filter_type' => 'text',
            'filter_index' => 'address',
        ));


        $this->addColumn(array(
            'name' => 'customer_name',
            'header' => trans('Customer'),
            'filter_type' => 'text',
        ));

        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 1){
            $this->addColumn(array(
                'name' => 'team_name',
                'header' => trans('Assigned Team'),
                'filter_type' => 'dropdown',
                'filter_index' => 'team_id',
                'filter_data' => array(
                    'collection' => \App\Models\Team::all(),
                    'field_value' => 'team_id',
                    'field_name' => 'team_name',
                    'extraOptions' => array('' => trans('- Please Select -'))
                )
            ));
        }


        $this->addColumn(array(
            'name' => 'comment',
            'header' => trans('Comment'),
            'renderer' => new \App\Blocks\Admin\Grid\Renderer\JobComment(),
        ));

        $this->addColumn(array(
            'name' => 'rating',
            'header' => trans('Rating'),
            'renderer' => new \App\Blocks\Admin\Grid\Renderer\JobRating(),
        ));

    }
}