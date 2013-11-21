<?php
namespace Module\index\model;
use Engine\Model as Models;

/**
 *Detemine which action is needed and execute the specific query
 *@return JSON
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


     private function isQueryable($param){

        $this->params = $param;
        if (Models\Model::_action($this->params->qt))//qt should be the query type.
        {
            //determine the action to execute on the data
            return true;
        }
        else
        {
            //throw new \Exception("Query cannot be made", 1);
            return false;
        }
     }

    public function _query($params)
    {
        if($this->isQueryable($params)){

        $id=1;
        $query = "SELECT * FROM user WHERE id=:id ";
        $array=array('id' => $id);
        $row = $this->_select ($query,$array);
        $this->json = $row;
        print_r($this->json);//Must return JSON encoded data.
        }
    }

    
    
}