<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class ServiceType extends Grid{

    protected $keyCol = 'st_id';

    protected function prepareCollection()
    {
        $model = new \App\Models\ServiceTypes();
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'st_id',
            'header' => trans('ID'),
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'st_name',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'st_price',
            'header' => trans('Price'),
            'filter_type' => 'text'
        ));

    }


}