<?php
namespace App\Controllers\Admin;


class ZipCodeController extends \Goxob\Core\Controller\AdminController {

    public function __construct()
    {
        $this->beforeFilter('restrictPermission');
        
        parent::__construct();
        $this->model = new \App\Models\ZipCode();
    }

}