<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class ServiceFrequency extends Grid{

    protected $keyCol = 'sf_id';

    protected function prepareCollection()
    {
        $model = new \App\Models\ServiceFrequencies();
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'sf_id',
            'header' => trans('ID'),
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'sf_name',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'sf_discount',
            'header' => trans('Discount'),
            'filter_type' => 'text'
        ));

    }


}