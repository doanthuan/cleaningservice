<?php
namespace App\Controllers\Admin;

use Auth, Session, Redirect, View, Input;

use \Goxob\Core\Html\Toolbar;

class ServiceTypeController extends \Goxob\Core\Controller\AdminController {

    public function __construct()
    {
        $this->beforeFilter('restrictPermission');
        
        parent::__construct();
        $this->model = new \App\Models\ServiceType();
    }

}