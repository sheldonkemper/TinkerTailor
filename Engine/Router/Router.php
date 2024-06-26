<?php
/**
 *@author Engine Kemper
 *@copyright Engine Kemper 2013
 *
 * CLASS Router 
 * Routes to include a specific module, determined by the GET request.
 */

namespace Engine\Router;

use Engine\Helper as Helper;
use Engine\Controller as Controller;
use Module as Module;


class Router 
{

protected $url = null;//Global url parameters passed.
protected $moduleRootDir = null; //Root Module directory.Set in Root index.php when initialised.
protected $moduleLoadFile = null;//Default global Load.php file expected.Set in Root index.php when initialised.
protected $customoduleDir = null;//The specific module which is passed in $url.
protected $customControllerFile = null;// controlling script for the module.
protected $fileExtension = '.php';//Default file extention of Load file.
public $defaultModuleFile = 'index';//If URL does not exist, then send to index.

    /**
     *PUBLIC Constructor
     *
     *@param string:$moduleDir Name of directory were all modules reside
     *@param string:$moduleLoadFile The expected cofiguration file name for each module
     *@return NULL
     *
     */
    public function __construct ($moduleDir,$moduleLoadFile)
    {
        $this->moduleRootDir = new Helper\DirExists ($moduleDir);
         $this->moduleLoadFile = $moduleLoadFile.$this->fileExtension;
    }

    /**
     * PUBLIC _get
     *The (object)URL is checked for specific parameters 
     *to load a module which resideds in the Module directory
     *
     *@param $get URL parameter
     *
     */
    public function _get ( $get)
    { 
        //strip GET to basename and converts to object.
        $urlValueRemove = new Helper\Url();
        $this->url = $urlValueRemove->convertBaseUrlArrayToObject($get);

        if (isset($this->url))
        {
            //Custom module directory.
            if (isset($this->url->m)) 
            {
                // $this->customoduleDir is now set;
                $this->_setModuleController ($this->url->m);  
            }
            else
            {
                //@TODO Consider it as a external link.Maybe?
                //Or possible a default internal page.
                //Or possible a 404.
               // throw new \Exception ("Needs Work!!Routed Url does not exists", 1);
               $this->_setModuleController ($this->defaultModuleFile);

            }
        }
        else
        {
            throw new \Exception ("Error Processing URL Request", 1);
        }
        
    }

    /*
     *PROTECTED _setcustomControllerFile
     *
     *$this->customoduleDir is set in _setCustomModuleDir ($cModule)
     *$this->moduleLoadFile which  is currently a CONSTANT set in index.php
     */
    protected function _setcustomControllerFile ()
    {
            if (isset($this->customoduleDir) && isset($this->moduleLoadFile))
            {
                  $loadFile = $this->customoduleDir.DIRECTORY_SEPARATOR.$this->moduleLoadFile;
                //Custom module load file
                if (file_exists($loadFile)){
                    //Itialize Load.php
                   $this->customControllerFile = $loadFile;
                   return $this->customControllerFile;
               }
               else
               {
                //@TODO If there is no custom directory.
               }
            }
            else
            {
                throw new \Exception("Directory||Loadfile not available", 1);
                
            }
    }

    /**
      *PROTECTED _setCustomModuleDir
      *
      *@param $cModule:String From Url
      *$this->moduleRootDir is a CONSTANT set in index.php
      */
    protected function _setCustomModuleDir ($cModule)
    {
        if (is_string($cModule))
        {
            if(isset($this->moduleRootDir))
            {
                $customModuleDir = $this->moduleRootDir.DIRECTORY_SEPARATOR.$cModule;
                if (new Helper\DirExists ($customModuleDir)) 
                {
                    $this->customoduleDir = $customModuleDir;
                }
                else
                {
                    throw new \Exception ("Module does not exist", 1);
                    
                }
            }
            else
            {
                throw new \Exception("All modules are not available", 1);
                
            }
           
        }
        else
        {
            throw new Exception ("Error Processing Request", 1);
            
        }
    }

     /**
     *PRIVATE _setModuleController
     *
     */
    private function _setModuleController ($module)
    {
          $this->_setCustomModuleDir ($this->url->m = $module);
                //Custom module load file
                //@see comments in _setcustomControllerFile().
                if ($this->_setcustomControllerFile())
                {
                   //Clone (object)URL
                   $clonedUrl = clone $this->url;
                   //Then unset the module and pass remained of url to Controller.
                   unset($clonedUrl->m);
                   $this->_controlContent ($this->customControllerFile,$clonedUrl);
                }
                else
                {
                    throw new \Exception("This module file still does not exists", 1);
                }
    }

    /**
     *PRIVATE _controlContent.
     *Initialize the Controller Class.
     *
     *@param $controller:String The path to the module load file.
     *@param  $params:Object Parameters from the url.
     *@return new Controller().
     */
     private function _controlContent ($controller,$params)
    {
            $control = new Controller\Controller($controller,$params);
    }
  
}//END CLASS