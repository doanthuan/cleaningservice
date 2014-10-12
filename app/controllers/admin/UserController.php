<?php
namespace App\Controllers\Admin;

use Auth, Session, Redirect, View, Input;

use \Goxob\Core\Html\Toolbar;

class UserController extends \Goxob\Core\Controller\AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\Models\User();
    }

    public function anyIndex()
    {
        $title = trans('Manage Team Members');
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_CREATE, Toolbar::BUTTON_DELETE)) ;

        return View::make('admin.user.index');
    }

    public function getCreate()
    {
        $title = trans('New Member');
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $item = $this->model;
        $data['item'] = $item;

        return View::make('admin.user.edit', $data);
    }

    public function getEdit()
    {
        $title = trans('Edit Team Member');
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $item = $this->model->find(Input::get('id'));
        if(is_null($item))
        {
            throw new \Exception('Could not find record');
        }
        $data['item'] = $item;

        return View::make('admin.'.$this->viewKey.'.edit', $data);
    }

    public function postEdit()
    {
        $input = Input::all();

        //store item to db
        $item = $this->model;
        if(!$item->validate($input))
        {
            return Redirect::back()->withErrors($item->getErrors())->withInput();
        }
        $item->setData($input);


        $key = \Config::get('maid.stripe_private_key');
        \Stripe::setApiKey($key);

        if(isset($_POST['stripeToken'])){
            $token_id = $_POST['stripeToken'];
            try {
            $recipient = \Stripe_Recipient::create(array(
                    "name" => $input['bank_name'],
                    "type" => "individual",
                    "bank_account" => $token_id,
                    "email" => $input['email'])
            );
            }
            catch(\Exception $e)
            {
                return Redirect::back()->withErrors($e->getMessage())->withInput();
            }
            $item->recipient_id = $recipient->id;
            $item->bank_account_id = $recipient->active_account->id;
        }

        $item->save();

        return \Redirect::to($this->objectUrl)->with('success', trans(ucfirst($this->viewKey).' Saved').'!');
    }
}