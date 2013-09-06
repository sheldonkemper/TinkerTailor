<?php
namespace Sheldon\Controller;
use Module as Module;
/*
 *View
 *
 *Process the Object for displaying on specific page.
 */
class Controller
{
    public function __construct($controller,$params)
    {
        $filename =  $controller;
        $module = trim(substr($filename , 0, -4));
        $loadFile = new $module($params);
        print $loadFile->_send();
    }
}