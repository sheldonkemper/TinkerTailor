<?php
namespace Engine\Database;
/**
 *@file Connects to a specific datastore
 *
 */
class Database 
{
    private $dbh = null;
    private static $_instance;
    const DNS = 'mysql:dbname=testdb;host=127.0.0.1';
    const USER = 'example';
    const PASSWORD = 'password';

    public static function getInstance()
    {
        if(!self::$_instance)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct ()
    {
        
        try
        {
            $this->dbh  = new \PDO(self::DNS, self::USER, self::PASSWORD, array(\PDO::ATTR_PERSISTENT => true));
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            /*  Note: If you're using the PDO ODBC driver and your ODBC libraries support 
                ODBC Connection Pooling (unixODBC and Windows are two that do; there may be more),
                then it's recommended that you don't use persistent PDO connections, 
                and instead leave the connection caching to the ODBC Connection Pooling layer. 
            */
     
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
        

    }

    private function __clone(){}

    public function getConnection() {
        return $this->dbh;
    }
}