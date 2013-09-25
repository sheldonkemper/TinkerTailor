<?php
namespace Engine\View;

class AssetCreation
{
    public $assetLink;

      public function __construct ($type,$data) 
    {
        $assetLink="";

        switch($type)
        {
            case 'link':
            $this->assetLink='<link rel="stylesheet"'." $data />";
            break;
            case 'style':
            $this->assetLink='<style type="text/css">'.$data ."</style>";
            break;
            case 'script':
            $this->assetLink="<script $data ></script>";
            break;
            default:
            break;
        }
        
    }

    public function __toString()
    {
        return $this->assetLink;
    }
}