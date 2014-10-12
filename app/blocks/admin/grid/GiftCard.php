<?php
namespace App\Blocks\Admin\Grid;

use Goxob\Core\Block\Grid;

class GiftCard extends Grid{

    public $actionCol = false;
    protected $keyCol = 'giftcard_id';

    protected function prepareCollection()
    {
        $model = new \App\Models\GiftCards();
        $items = $this->getData($model);

        return $items;
    }

    protected function prepareColumns()
    {
        $this->addColumn(array(
            'name' => 'gift_amount',
            'header' => 'Giftcard Amount',
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'balance',
            'header' => 'Balance',
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'to_email',
            'header' => 'To Email',
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'from_email',
            'header' => 'From Email',
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'discount_code',
            'header' => 'Code',
            'filter_type' => 'text'
        ));

        $this->addColumn(array(
            'name' => 'unlimited',
            'header' => 'Unlimited'
        ));


    }


}