<?php
namespace Engine\Helper;
class IncludeAsVariable
{
    
    public function __construct( $filename)
    {
        if (is_file($filename)) 
        {
            ob_start();
            include $filename;
            return ob_get_clean();
        }
    }
}