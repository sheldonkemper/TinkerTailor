<?php
namespace Module\index;
use Module\index\model as Model;
use Module\index\view as moduleView;

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
    }
    /**
     *
     *
     */
    public function _send()
    {
        $this->view = new moduleView\View($this->params);//TODO Add data from model to be transformed
        //$this->view->_send();

    }
}