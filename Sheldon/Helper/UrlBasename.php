<?php
namespace Sheldon\Helper;
class   UrlBasename
{
    public $objUrl="";

    public function __construct ($urls)
        {
            $this->objUrl = $urls;

            foreach ($this->objUrl as $key => $value) {
                $this->objUrl[basename($key)]=basename($value);
            }
            return $this->objUrl;
           
        }
}
