<?php
namespace Module\index\view;
use Sheldon\View as InterfaceView;
/**
 *@file
 *
 */
class View implements InterfaceView\View
{
    public $values;

    public function __construct ($array)
    {
        $this->values=$array;
    }

    public function _send()
    {

         $this->_include();
    }

    public function _include()
    {
        $value = $this->values;
        include 'fragment.inc';
    }
    public function _processDataForDisplay ()
    {
        
    }

}