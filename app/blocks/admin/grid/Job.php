<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class Job extends Grid{

    protected $keyCol = 'job_id';
    //public $actionColCls = 'col-sm-2';

    protected function prepareCollection()
    {
        $model = new \App\Models\Jobs();
        $query = $model->getSelect()->addSelect(\DB::raw('CONCAT(job.address, \' \', job.city, \' \', job.state) as job_address'))->orderBy('take_time', 'desc');

        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 2){
            $query->where('job.team_id', $user->team_id);
            $query->where('job.status', \App\Models\Job::STATUS_ASSIGNED);
        }

        $items = $this->getData($query);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'take_time',
            'header' => trans('Time'),
            'filter_type' => 'date_range',
            'filter_index' => 'take_time',
            'class' => 'col-sm-1',
            'options' => array('All' => 'All', 'day' => 'Today', 'week' => 'This Week', 'month' => 'This Month')
        ));

        $this->addColumn(array(
            'name' => 'job_address',
            'header' => trans('Address'),
            //'renderer' => new \App\Blocks\Admin\Grid\Renderer\JobAddress(),
            'filter_type' => 'text',
            'filter_index' => 'address',
        ));


        $this->addColumn(array(
            'name' => 'customer_email',
            'header' => trans('Email'),
            'filter_type' => 'text',
            'class' => 'col-sm-1'
        ));

        $this->addColumn(array(
            'name' => 'customer_phone',
            'header' => trans('Phone'),
            'filter_type' => 'text',
            'class' => 'col-sm-1'
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

            $this->addColumn(array(
                'name' => 'status',
                'header' => trans('Status'),
                'renderer' => new \App\Blocks\Admin\Grid\Renderer\JobStatus(),
                'filter_type' => 'dropdown',
                'filter_index' => 'status',
                'filter_data' => array(
                    'collection' => \App\Models\Job::getStatusList(),
                    'extraOptions' => array('' => trans('- Please Select -'))
                )
            ));
        }


    }

    public function getActionLinks($item, $i)
    {
        $editLink = parent::getActionLinks($item, $i);
        $user = \Goxob\Core\Helper\Auth::user();
        $html  = '';
        if($item->status == \App\Models\Job::STATUS_CARD_APPROVED){
            $html = '<button type="button" class="btn btn-sm btn-success" onclick="showTeams(\''.$item->job_id.'\',
            \''.$item->team_id.'\', \''.$item->team_revenue.'\')"><i class="fa fa-user"></i></button>'.'&nbsp;'
            .$editLink;
             
             if($user->role_id == 1){
             	$html = $html.'<div class="pull-right"><button type="button" class="btn btn-sm btn-danger" onclick="listItemTask(\'cb'.$i.'\',
            		\'updateJobStatus\', \''.\App\Models\Job::STATUS_CANCELED.'\')"><i class="fa fa-times"></i></button></div>';
            }
        }
        elseif($item->status == \App\Models\Job::STATUS_ASSIGNED){
            $html = '<button type="button" class="btn btn-sm btn-success" onclick="listItemTask(\'cb'.$i.'\',
            \'updateJobStatus\', \''.\App\Models\Job::STATUS_COMPLETED.'\')"><i class="fa fa-check"></i></button>';
            
            //$user = \Goxob\Core\Helper\Auth::user();
            if($user->role_id == 1){
                $html = $html.'&nbsp;'.'<button type="button" class="btn btn-sm btn-warning" onclick="showTeams(\''.$item->job_id.'\',
                \''.$item->team_id.'\', \''.$item->team_revenue.'\')"><i class="fa fa-undo"></i></button>&nbsp;'
                .$editLink
                .'<div class="pull-right"><button type="button" class="btn btn-sm btn-danger" onclick="listItemTask(\'cb'.$i.'\',
            		\'updateJobStatus\', \''.\App\Models\Job::STATUS_CANCELED.'\')"><i class="fa fa-times"></i></button></div>';
            }
        }
        elseif($item->status == \App\Models\Job::STATUS_PAID){
            $html = '<button type="button" class="btn btn-sm btn-success" onclick="listItemTask(\'cb'.$i.'\',
            \'updateJobStatus\', \''.\App\Models\Job::STATUS_PAID_TEAM.'\')">Paid Team</button>';
        }
        elseif($item->status == \App\Models\Job::STATUS_PAID_TEAM && $item->service_frequency == 1){
            $html = $html.'&nbsp;'.'<button type="button" class="btn btn-sm btn-warning" onclick="showRecurringJob(\''.$item->job_id.'\')">Recurring Job</button>&nbsp;';

        }
        return $html;
    }

}