<?php
/**
 *@author Engine Kemper
 *@copyright Engine Kemper 2013
 *
 * CLASS URL 
 *Provide a helper to work on URLs
 */
namespace Engine\Helper;


class Url
{
    
    public $objGet;
    public $unsetValue;

    /**
     *Initialises the ArraytoObject class
     *
     */
    public function __construct()
    {
        $this->objGet = new ArrayToObject();
    }

    /**
     *Removes a passed value from a object property after detrmining if it is a object.
     *
     */
    public function unsetValue($param,$KeytoUnset)
    {
    
       $objParam =!is_object($param)?$this->objGet->convert ($param):$param;
        $clonedUrl = clone $objParam ;
        unset($clonedUrl->$KeytoUnset);
        return $clonedUrl;
    }

    /**
     *We will need the unset values from the url for other purposes, so lets save it here.
     *
     */
    public function getUnsetValue()
    {
        return $this->unsetValue;
    }

    /**
     *Converts a  url stripped to basename to a object.
     *
     */
     public function convertBaseUrlArrayToObject ($url)
    {
        $param = $this->_urlBasename ($url);
          //convert url array to object.
        return $this->objGet->convert ($param);
    }

    /**
     *Converts a  url stripped to basename.
     *
     */
   public function _urlBasename ($url)
    {    
        foreach ($url as $key => $value) {
            $url[basename($key)]=basename($value);
        }
        return $url;
    }

}//END CLASS
