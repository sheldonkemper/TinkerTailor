<?php
namespace Engine\Model;
use Engine\Database as Database;
use Engine\Helper as Helper;
/**
 *Create general purpose methods to query  database 
 *
 */
class Model extends Database\Database
{
    protected $connection;//The database handler.

    /**
     *Used to determine if the method exists in the class.
     *
     */
  protected function _action($string)
    {
        $isMethod = new Helper\ClassHelper();
        return $isMethod ->isMethodInClass(__CLASS__,$string);
    }

    /**
     *
     *
     */
    private function _connection() 
    {
        $db = $this->getInstance();
        $this->connection = $db->getConnection();
        return true;

    }
    /**
     *Use a prepared statement to query database.
     *@param $query:String sql prepared statement.
     *@param $array:Array parameters to pass.
     *@return Fetches a row from a result set associated with a PDOStatement object.
     *
     */
    public function _select ($query,$array)
    {
        if( $this->_connection() ){
            
            $stmt = $this->connection->prepare($query);
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