<?php
namespace Sheldon\Controller;
use Module as Module;
/*
 *View
 *
 *Process the Object for displaying on specific page.
 *@TODO Better method to determine if the class exists.
 */
class Controller
{
    private $filename;
    private $module;
    private $loadFile;

    public function __construct($controller,$params)
    {
        $this->filename =  $controller;
        $this->module = trim(substr($this->filename , 0, -4));
        $this->loadFile = new $this->module($params);
        print $this->loadFile->_send();
    }
}