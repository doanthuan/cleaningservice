<?php
namespace App\Controllers\Admin;


class GiftCardController extends \Goxob\Core\Controller\AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\Models\GiftCard();
    }

    public function postEdit()
    {
        $input = \Input::all();

        //store item to db
        $item = $this->model;
        $item->gift_amount = $input['gift_amount'];
        $item->balance = $item->gift_amount;
        $item->discount_code = $input['discount_code'];
        if(isset($input['unlimited'])) {
            $item->unlimited = $input['unlimited'];
        }

        $item->save();

        return \Redirect::to($this->objectUrl)->with('success', trans(ucfirst($this->viewKey).' Saved').'!');
    }
}