<?php
namespace Sheldon\Database;
/**
 *@file
 *
 */
class Database 
{
    public $dbh=null;
    public static $dbtest;

    public function __construct ()
    {
        //PDO Connection details..
        //Needs work..
        //TODO extract database connection details.And..
        $dsn = 'mysql:dbname=testdb;host=127.0.0.1';
        $user = 'example';
        $password = 'password';
        try
        {
            self::$dbtest=new \PDO($dsn, $user, $password);
            self::$dbtest->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return self::$dbtest;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        

    }
}