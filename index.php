<?php

/**
 *@author Engine Kemper
 *@copyright Engine Kemper 2013
 *
 *@file Welcome to the  doorstep. 
 * 
 *@comment  Initialises the Router class by passing a GET request and catches any errors from the underlining scripts.
 *Global parameters can be set here such as error dosplay.
 */

//use \Engine\Text as Text;
//use \Engine\File as File;
use \Engine\Helper as Helper;
use \Engine\Router as Router;

include('Engine\autoload.php');

//Module directory
define("MODULEROOT", "Module");
//Default module load file.
define("LOADFILE", "Load");

//To test how this currently works. Put into url ?m=test&c=test
try{
    
$router = new Router\Router(MODULEROOT,LOADFILE);
$router->_get($_GET);

}
catch(Exception $e) 
{
echo $e->getMessage();
}
