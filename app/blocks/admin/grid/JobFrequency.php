<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class JobFrequency extends Job{

    public $actionColCls = 'col-sm-1';
    protected function prepareCollection()
    {
        $model = new \App\Models\Jobs();
        $query = $model->getSelect()->addSelect(\DB::raw('CONCAT(job.address, \' \', job.city, \' \', job.state) as job_address'));
        $query->addSelect('service_frequency.sf_name');
        $query->leftJoin('service_frequency', 'service_frequency.sf_id', '=', 'job.service_frequency' );

        $query->where('service_frequency', '>', 1)->where('recurringjob', 0);

        $items = $this->getData($query);

        return $items;
    }

    public function getActionLinks($item, $i)
    {
        $text = empty($item->recurring_pause)?'Pause':'Resume';
        $button_text = empty($item->recurring_pause)?'danger':'success';
        $value = empty($item->recurring_pause)?'1':'0';
        
        $button = '<button type="button" class="btn btn-sm btn-'. $button_text .'" onclick="pauseOrResumeJob(\''.$item->job_id.'\', '.$value.')">'.$text.'</button>';
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
            'filter_type' => 'text'
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
            'name' => 'sf_name',
            'header' => 'Service Frequency'
        ));

    }
}