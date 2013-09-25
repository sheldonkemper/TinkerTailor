<?php
namespace Module\index\view;
use Engine\View as MainView;
/**
 *@file
 *
 */
class View extends MainView\View
{
    public $values="hello";
    
    public function __construct ($data)
    {
        MainView\View::__construct();
    }
     public function _setBody ()
    {

         $this->body = $this->_include();
    }


    public function _include()
    {
        $filename=__DIR__."/fragment.inc";


        if (is_file($filename)) 
        {
            ob_start();
            include $filename;
            return ob_get_clean();
        }

    }

    public function _processDataForDisplay ()
    {
        
    }

}