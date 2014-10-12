<?php
namespace Goxob\Core\Controller;
use Input, View;

class AdminBaseController extends \Goxob\Core\Controller\BaseController {

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('admin.auth');
    }

    public function callAction($method, $parameters)
    {
        $task = Input::get('task');
        if(!empty($task)){
            $method = $task;
        }
        $response = parent::callAction($method, $parameters);

        //after controller action
        $toolbar = \Goxob\Core\Html\Toolbar::toHtml();
        View::share('toolbar', $toolbar);

        return $response;
    }

}