<?php
namespace Module\index\view;
use Engine\View as MainView;
/**
 *@file
 *
 */
class View extends MainView\View
{
    public $values;
    
    public function __construct ($data)
    {
        $this->values=$data;
        MainView\View::__construct();
    }

    public function __toString()
    {
        return $this->value;
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