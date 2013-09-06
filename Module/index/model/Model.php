<?php
namespace Module\index\model;
use Sheldon\Model as Models;

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
        Models\Model::__construct();
        $this->params = $param;
        echo "\n".'<br>'.'Hello from loading....Index Model module - url params are :'.print_r($this->params)."\n".'<br>';
    }

    public function _get()
    {
        $id=1;
        $query = "SELECT * FROM user WHERE id=:id ";
        $array=array('id' => $id);
        $row = Models\Model::_select ($query,$array);
        print_r($row);
    }
    
    public function __construct ($param)
    {
        $this->params = $param;
        
        //parent::__construct();
       echo "\n".'<br>'.'Hello from loading....Index Model module - url params are :'.print_r($this->params)."\n".'<br>';
    }
}