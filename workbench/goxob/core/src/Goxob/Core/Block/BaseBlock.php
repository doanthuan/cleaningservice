<?php
namespace Goxob\Core\Block;
use Controller, View, Session;

class BaseBlock{

    protected $defaultTemplate = null;
    public $params = array();

    public function setParams($params)
    {
        $this->params = $params;
    }
    public function getParams()
    {
        return $this->params;
    }

    public function setDefaultTemplate($defaultTemplate)
    {
        $this->defaultTemplate = $defaultTemplate;
    }

    protected function getTemplate()
    {
        if(!isset($this->params['template'])){
            if(!isset($this->defaultTemplate)){
                $class = get_class();
                throw new \InvalidArgumentException("Block:{$class} has no template to render.");
            }
            $this->params['template'] = $this->defaultTemplate;
        }

        $template = $this->params['template'];
        return $template;
    }

    public function toHtml()
    {
        $template = $this->getTemplate();

        $data = $this->prepareData();

        foreach($this->params as $key => $value)
        {
            $data[$key] = $value;
        }

        if(isset($this->params['parent']->params['frontend'])){
            $this->params['frontend'] = true;
        }
        $data['block'] = $this;
        return View::make($template, $data)->render();
    }

    protected function prepareData()
    {
        return array();
    }

}