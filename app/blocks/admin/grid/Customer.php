<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class Customer extends Grid{

    protected $keyCol = 'customer_id';

    protected function prepareCollection()
    {
        $model = new \App\Models\Customers();
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'first_name',
            'header' => trans('First Name'),
            'filter_type' => 'text',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'last_name',
            'header' => trans('Last Name'),
            'filter_type' => 'text',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'email',
            'header' => trans('Email'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'phone',
            'header' => trans('Phone'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'address',
            'header' => trans('Address'),
            'filter_type' => 'text'
        ));


        $this->addColumn(array(
            'name' => 'created_at',
            'header' => trans('Date Added')
        ));


    }


}