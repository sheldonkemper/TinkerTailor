<?php
namespace Engine\Model;
use Engine\Database as Database;
use Engine\Helper as Helper;
/**
 *@file
 *
 */
class Model extends Database\Database
{

  protected function _action($string)
    {
        $isMethod = new Helper\ClassHelper();
        return $isMethod ->isMethodInClass(__CLASS__,$string);
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
    public function _insert ($query,$array)
    {
        if(self::$dbtest){
            
            $stmt = self::$dbtest->prepare($query);
            $stmt->execute($array);
            $newId = self::$dbtest->lastInsertId();
            return $newId;
            
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