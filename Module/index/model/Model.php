<?php
namespace Module\index\model;
use Sheldon\Model as Models;

/**
 *@file To detemine which action is needed and execute the specific query
 *
 *
 */
class Model extends Models\Model
{
    /**
     *
     *
     */
    protected $params;


    public function __construct ($action,$param) 
    {
        Models\Model::__construct();
        $this->params = $param;
        Models\Model::_action($action);
        //echo "\n".'<br>'.'Hello from loading....Index Model module - url params are :'.print_r($this->params)."\n".'<br>';
    }

    public function _select()
    {
        $id=1;
        $query = "SELECT * FROM user WHERE id=:id ";
        $array=array('id' => $id);
        $row = Models\Model::_select ($query,$array);
        print_r($row);
    }

    
    
}