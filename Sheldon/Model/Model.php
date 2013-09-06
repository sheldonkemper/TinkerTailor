<?php
namespace Sheldon\Model;
use Sheldon\Database as Database;
/**
 *@file
 *
 */


class Model extends Database\Database
{

    
    /**
     *
     *
     */
    /*
    //public $dbh;
    public function __construct()
    {
       $this->dbh = Database\Database::__construct();
    }
    */

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