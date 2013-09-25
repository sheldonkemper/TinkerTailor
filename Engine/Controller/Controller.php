<?php
namespace Engine\Controller;
use Module as Module;
use Engine\View as View;
/**
 *
 *Process the Object for displaying on specific page.
 *@TODO load a global database connection
 *@TODO load a  global view...maybe
 */
class Controller
{
    private $filename;
    private $module;
    private $loadFile;
    public $paramsToPass;

    /**
     * public __construct
     *
     */
    public function __construct ($controller,$params)
    {
        
        $this->_fileExist($controller,$params);
    }

    public function fragmentLoader()
    {
        $view = new View\View ();
    }

    /**
     * private _fileExist 
     *
     *
     */
    private function _fileExist ($controller,$params)
    { 
        $this->filename =  $controller;//
        $this->paramsToPass = $params;
        $this->_loadModule ();
    }

    /**
     *private _loadModule.
     *Checks if a Module class exists and has a callable method.
     *A check was done in the Router class to determine if the correct file exists in the location
     *
     */
    private function _loadModule ()
    {
        $this->module = trim(substr($this->filename , 0, -4));//strips the php extension from the filename
        if (class_exists($this->module))
        {
            $this->loadFile = new $this->module($this->paramsToPass);//Initialises the Load class, passing in the URL params
            
            if(method_exists($this->loadFile, '_send'))
            {
                $method = $this->loadFile->_send();
                return  $method;//executes the results
            }
            else
            {
                throw new \Exception("Check available method of this module", 1);
                
            }
        }
        else
        {
            throw new \Exception("Loading module file does not exist", 1);
            
        }
        
        //
    }

    
}