<?php
namespace Module\index\model;
use Engine\Model as Models;

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
    public $json;


    public function __construct ($action,$param) 
    {
        Models\Model::__construct();
        $this->params = $param;
        if (Models\Model::_action($action))
        {

        }
        else
        {
            throw new \Exception("Query cannot be made", 1);
        }

    }

    public function _select()
    {
        $id=1;
        $query = "SELECT * FROM user WHERE id=:id ";
        $array=array('id' => $id);
        $row = Models\Model::_select ($query,$array);
        return $this->json = $row;
    }

    
    
}