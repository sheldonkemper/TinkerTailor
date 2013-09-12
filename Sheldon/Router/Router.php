<?php
/**
 *@author Sheldon Kemper
 *@copyright Sheldon Kemper 2013
 *
 *@file Router class files. 
 * 
 *@comment Routes to include a specific module, determined by the GET request.
 */

namespace Sheldon\Router;

use Sheldon\Helper as Helper;
use Sheldon\Controller as Controller;
use Module as Module;


class Router 
{

protected $url = null;//Global url parameters passed.
protected $moduleRootDir = null; //Root Module directory.Set in Root index.php when initialised.
protected $moduleLoadFile = null;//Default global Load.php file expected.Set in Root index.php when initialised.
protected $customoduleDir = null;//The specific module which is passed in $url.
protected $customController = null;// controlling script for the module.
protected $fileExtension = '.php';//Default file extention of Load file.

    /**
     *Constructor
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
        $this->url =  $this->_convertBaseUrlArrayToObject ($get);

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
               $this->_setModuleController ('index');

            }
        }
        else
        {
            throw new \Exception ("Error Processing URL Request", 1);
        }
        
    }

    /**
     *_setModuleController
     *
     */
    private function _setModuleController ($module)
    {
          $this->_setCustomModuleDir ($this->url->m = $module);
                //Custom module load file
                //@see comments in _setCustomController().
                if ($this->_setCustomController())
                {
                   //Clone (object)URL
                   $clonedUrl = clone $this->url;
                   //Then unset the module and pass remained of url to Controller.
                   unset($clonedUrl->m);
                   $this->_controlContent ($this->customController,$clonedUrl);
                }
                else
                {
                    throw new \Exception("This module file still does not exists", 1);
                }
    }

    /**
     *Private _viewContent
     *
     *@comment Initialize the Controller Class.
     *@param $controller:String The path to the module load file.
     *@param  $params:Object Parameters from the url.
     *@return new Controller().
     */
     private function _controlContent ($controller,$params)
    {
            $control = new Controller\Controller($controller,$params);
    }

    /*
     *_setCustomController
     *
     *$this->customoduleDir is set in _setCustomModuleDir ($cModule)
     *$this->moduleLoadFile which  is currently a CONSTANT set in index.php
     */
    protected function _setCustomController ()
    {
            if (isset($this->customoduleDir)&&isset($this->moduleLoadFile))
            {
                  $loadFile = $this->customoduleDir.DIRECTORY_SEPARATOR.$this->moduleLoadFile;
                //Custom module load file
                if (file_exists($loadFile)){
                    //Itialize Load.php
                   $this->customController = $loadFile;
                   return $this->customController;
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
      *_setCustomModuleDir
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

    /*
     *_urlBasename
     *
     *A helper method which strips the url down to its basename.
     *
     */
    protected function _urlBasename ($url)
    {
              
        foreach ($url as $key => $value) {
            $url[basename($key)]=basename($value);
        }
        return $url;
       
    }

    /*
     *_convertBaseUrlArrayToObject
     *
     *Use ARRAY as OBJECT
     *
     */
    protected function _convertBaseUrlArrayToObject ($url)
    {
        $param = $this->_urlBasename ($url);
          //convert url array to object.
        $objGet = new Helper\ArrayToObject();
        return $objGet->convert ($param);
    }

  
}//End Class