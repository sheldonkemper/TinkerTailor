<?php
namespace Sheldon\View;

interface View
{
    public function __construct ($array);
    
    public function _send () ;
    
}