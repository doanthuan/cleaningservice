<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class JobCompleted extends Job{

    protected function prepareCollection()
    {
        $model = new \App\Models\Jobs();
        $query = $model->getSelect()->addSelect(\DB::raw('CONCAT(job.address, \' \', job.city, \' \', job.state) as job_address'));

        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 2){
            $query->where('job.team_id', $user->team_id);
        }
        $query->where('job.status', \App\Models\Job::STATUS_COMPLETED);

        $items = $this->getData($query);

        return $items;
    }

    public function getActionLinks($item, $i)
    {
        $button = '<button type="button" class="btn btn-sm btn-success" onclick="chargeJob(\''.$item->job_id.'\')">Charge</button>';
        //$links = '';
        //$links .= '<a href="/admin/sale/order/detail/'.$item->getKey().'">'.trans('View').'</a>';
        return $button;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'take_time',
            'header' => trans('Time'),
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
            'name' => 'amount',
            'header' => 'Amount',
            'renderer' => new \App\Blocks\Admin\Grid\Renderer\JobAmount()
        ));
    }
}