<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class JobPaidTeam extends Job{

    public $actionCol = false;

    protected function prepareCollection()
    {
        $model = new \App\Models\Jobs();
        $query = $model->getSelect()->addSelect(\DB::raw('CONCAT(job.address, \' \', job.city, \' \', job.state) as job_address'));
        $query->addSelect(\DB::raw('TRUNCATE( (amount + giftcard_amount) * team_revenue / 100 , 2) as paid_amount'));

        $user = \Goxob\Core\Helper\Auth::user();
        if($user->role_id == 2){
            $query->where('job.team_id', $user->team_id);
        }
        $query->whereIn('job.status', array(\App\Models\Job::STATUS_PAID_TEAM,
            \App\Models\Job::STATUS_COMPLETED,
            \App\Models\Job::STATUS_PAID));

        $items = $this->getData($query);

        return $items;
    }

    public function getActionLinks($item, $i)
    {
        return '';
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
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'customer_phone',
            'header' => trans('Phone'),
            'filter_type' => 'text',
        ));

        $this->addColumn(array(
            'name' => 'amount',
            'header' => 'Amount'
        ));

        $this->addColumn(array(
            'name' => 'status',
            'header' => trans('Status'),
            'renderer' => new \App\Blocks\Admin\Grid\Renderer\JobStatus(),
            'filter_type' => 'dropdown',
            'filter_index' => 'status',
            'filter_data' => array(
                'collection' => \App\Models\Job::getCompletedStatusList(),
                'extraOptions' => array('' => trans('- Please Select -'))
            )
        ));

        $this->addColumn(array(
            'name' => 'paid_amount',
            'header' => 'Paid Team Amount'
        ));
    }
}