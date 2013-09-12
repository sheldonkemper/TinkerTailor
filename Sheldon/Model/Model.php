<?php
namespace Sheldon\Model;
use Sheldon\Database as Database;
/**
 *@file
 *
 */


class Model extends Database\Database
{

  protected function _action($string)
    {
        $method = '_'.$string;
        if(method_exists(__CLASS__,$method))
        {
            return true;
        }
        else
        {
            throw new \Exception("Method does not exists", 1);
            
        }
    }

    /**
     *
     *
     */
    public function _select ($query,$array)
    {
        if(self::$dbtest){
            
            $stmt = self::$dbtest->prepare($query);
            $stmt->execute($array);
            return $stmt->fetch();
        }
        else
        {
            throw new \Exception("Please try later", 1);
            
        }
    }
    /**
     *
     *
     */
    public function _update ()
    {

    }
    /**
     *
     *
     */
    public function _delete ()
    {

    }
}