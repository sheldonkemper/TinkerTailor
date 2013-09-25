<?php
namespace Engine\View;

/**
 * @file Loads a default file, which modules can extend
 *@todo Need to be able to load any number of css and js files.Currently only one of each is possible.
 *@todo Further documentation of this Class.
 *
 */
class View
{
    public $doctype;
    public $encoding;
    public $title;
    public $body;
    public $css;
    public $js;

    public function __construct ()
    {
        $this->_setHeadData ();
        $this->_setBody ();
        $this->_includeFragment ();
    }
    
    public function _includeFragment ()
    {
        include(__DIR__.DIRECTORY_SEPARATOR.'fragment.inc');
    }

    /**
     *Document type
     *
     */
   public function _getDocType ()
   {
    return $this->doctype;
   }

   public function _setDocType ($type = '<!DOCTYPE html>') 
   {
    $this->doctype = $type;
   }

   public function _setHeadData ()
   {
        $this->_setDocType ();
        $this->_setEncoding ();
        $this->_setTitle();
        $this->_setCSS ();
        $this->_setJS ();
   }
   /**
    *Document encoding
    *
    */
   public function _getEncoding ()
   {
        return $this->encoding;
   }

   public function _setEncoding ($data = 'charset="UTF-8"')
   {
    $this->encoding = $this->_meta($data);
   }

    public function _meta ($data)
    {
        return "<meta $data>";
    }

    /*
     *Document Title
     *
     */
     public function _getTitle ()
    {
        return $this->title;
    }

     public function _setTitle ($data=null)
    {
        $this->title = "<title>$data</title>";
    }

    /**
     *Assets
     *
     */
   

    public function _setCSS ()
    {
        $this->css = new AssetCreation('link','href="Assets/css/asset_style.css"');
    }

     public function _getCSS ()
    {
        return $this->css;
    }

     public function _setJS ()
    {
        $this->js = new AssetCreation('script','src="Assets/js/asset_script.js"');
    }

     public function _getJS ()
    {}

    /**
     * Document body
     *
     */
    public function _setBody ($data=null)
    {
        $this->body = $data;
    }

    public function _getBody ()
    {
        return $this->body;
    }


    public function _send () 
    {}
    
}