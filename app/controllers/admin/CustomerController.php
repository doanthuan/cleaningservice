<?php
namespace App\Controllers\Admin;

use Auth, Session, Redirect, View, Input;

use \Goxob\Core\Html\Toolbar;

class CustomerController extends \Goxob\Core\Controller\AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\Models\Customer();
    }

}