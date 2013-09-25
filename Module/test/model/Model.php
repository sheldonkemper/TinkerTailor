<?php
namespace Module\test\model;
use Engine\Model as Models;

/**
 *@file
 *
 */
class Model extends Models\Model
{
    /**
     *
     *
     */
    protected $params;
    public function __construct ($param)
    {
        $this->params = $param;
        //parent::__construct();
        echo "\n".'<br>'.'Hello from loading....Test Model module - url params are :'.print_r($this->params);
    }
}