<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class User extends Grid{

    protected $keyCol = 'user_id';

    protected function prepareCollection()
    {
        $model = new \App\Models\Users();
        $query = $model->getSelect()->where('role_id', 2);
        $items = $this->getData($query);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'user_id',
            'header' => trans('ID'),
            'filter_type' => 'range',
            'class' => "col-md-1"
        ));

        $this->addColumn(array(
            'name' => 'username',
            'header' => trans('Username'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'email',
            'header' => trans('Email'),
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'team_name',
            'header' => trans('Team'),
            'filter_type' => 'dropdown',
            'filter_index' => 'team_id',
            'filter_data' => array(
                'collection' => \App\Models\Team::all(),
                'field_value' => 'team_id',
                'field_name' => 'team_name',
                'extraOptions' => array('' => trans('- Please Select -'))
            )
        ));

//        $this->addColumn(array(
//            'name' => 'status',
//            'header' => trans('Status'),
//            'filter_type' => 'dropdown',
//            'filter_index' => 'status',
//            'filter_data' => array(
//                'collection' => array('1' => 'Enable', '0' => 'Disable')
//            ),
//            'published' => true,
//        ));

        $this->addColumn(array(
            'name' => 'created_at',
            'header' => trans('Date Added'),
            'filter_type' => 'range',
        ));


    }


}