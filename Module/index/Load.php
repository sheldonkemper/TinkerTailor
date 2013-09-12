<?php
namespace Module\index;
use Module\index\model as Model;
use Module\index\view as View;

/**
 *@file
 *
 *To accept parameters which are queryable and then inject into a fragment template
 *@return fragment.inc
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

        $this->model = new Model\Model('select',$this->params);
        $v = new View\View('Must add array from model');
    }
    /**
     *
     *
     */
    public function _send()
    {
    

        $modelData = $this->model->_select();//TODO delete.
        $this->view = new View\View('<br>'.'Hello from loading.... Index load module - url params are :'.print_r($this->params).$modelData);
        $this->view->_send();
    }
}