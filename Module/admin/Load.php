<?php
namespace Module\test;
use Module\test\model as Model;
use Module\test\view as View;
/*
 *Load
 *
 *Must return a Object of data,such as JSON
 */
class Load 
{
    protected $params;

    public function __construct($param)
    {
        //Possible add some indication of where the data must display
        $this->params = $param;
        $m = new Model\Model($this->params);
        $v = new View\View();
    }

    public function _send()
    {
        echo "\n".'<br>'.'Hello from loading....Test load module - url params are :'.print_r($this->params);
    }
}