<?php
namespace Module\index;
use Module\index\model as Model;
use Module\index\view as View;

/**
 *@file
 *
 */
class Load
{
    /**
     *
     *
     */
    protected $params;

    protected $model;
    protected $view;

    public function __construct($param)
    {
        $this->params = $param;

        $this->model = new Model\Model($this->params);
        $m = new Model\Model($this->params);
        $v = new View\View();

    }
    /**
     *
     *
     */
    public function _send()
    {
        echo "\n".'<br>'.'Hello from loading.... Index load module - url params are :'.print_r($this->params)."\t\n".'<br>';

        $modelData = $this->model->_get();
        $this->view = new View\View($modelData);

    }
}