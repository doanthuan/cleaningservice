<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class ZipCode extends Grid{

    protected $keyCol = 'zipcode_id';

    protected function prepareCollection()
    {
        $model = new \App\Models\ZipCodes();
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'zipcode_id',
            'header' => trans('ID'),
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'zipcode',
            'header' => trans('Name'),
            'filter_type' => 'text'
        ));

    }


}