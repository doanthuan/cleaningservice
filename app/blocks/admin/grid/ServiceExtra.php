<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class ServiceExtra extends Grid{

    protected $keyCol = 'se_id';

    protected function prepareCollection()
    {
        $model = new \App\Models\ServiceExtras();
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'se_id',
            'header' => trans('ID'),
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'se_name',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'se_price',
            'header' => trans('Price'),
            'filter_type' => 'text'
        ));

    }


}