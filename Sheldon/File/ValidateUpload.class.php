<?php
/**
 *@author sheldonkemper
 *@copyright 2013-2014 Sheldon Kemper
 *@license http://opensource.org/licenses/GPL-3.0
 *
 *@file Verify multiple file upload stored in temp dir
 *
 * This class is designed to be extended.
 * Accepts a post array of files.
 * Extracts the array elements
 * Checks for file upload errors, stored in $errorFileArray
 * Acceptable files stored in $validFileArray
 * Remove any empty indexs from $validFileArray,If the was a error. 
 *Returns as a protected packed object
 *
 *@todo Class in progress......
 */
namespace Sheldon\File;

class ValidateUpload
{
    private static $fileUploadDir;//directory to upload the file to
    private $formName;//the name passed from the form
    private$error;//error number of uploaded file
    private $name ;//name pf uploaded file
    private $type ;//type of uploaded file
    private $size ;//size of uploaded file
    private $tmpName;//uploaded file temp destination
    private $errorFileArray = array();//array of error numbers
    private $validFileArray = array();//array of files uploaded
    protected $obj;//contains the file values, used in movefileupload

/**
 *Constructor
 *
 *@param string:$name Name of form 
 *@param string:$dir Directory destination for uploads
 *@return 
 *
 */ 
    public function __construct($name,$dir) {
        $this->fileUploadDir = $dir;
        $this->formName = $name;    
        $this->extractUpload () ;
        $this->getErrors ();
        $this->unsetEmptyFileArray();
    }//end construct method

/**
 * private Extract Upload
 *
 *Loop through POST(array),assigning values to named (array) variables 
 *
 */ 
    private function extractUpload () {
        foreach ($_FILES[$this->formName] as $key=>$value) {
            switch ($key) 
            {
                case 'error':
                    $this->error = $value;
                    break;
                case 'name':
                    $this->name = $value;
                    break;
                case 'type':
                    $this->type = $value;
                    break;
                case 'size':
                    $this->size = $value;
                    break;
                case 'tmp_name':
                    $this->tmpName = $value;
                    break;
            }//end switch
        }//end foreach
    }//end extractUpload method

/**
 * If errors exist then added to errorFileArray (array)
 * Else added to validfileArray (array)
 *
 */
    public function getErrors () {
        foreach ($this->error as $k=>$v) {
            switch ($v) {
            case 0:
            $this->validFileArray['name']= $this->name;
            $this->validFileArray['tmp_name']= $this->tmpName;
            $this->validFileArray['type']=$this->type;
            $this->validFileArray['size']=$this->size;
            break;
            case 1:
            $this->errorFileArray[]= 1;
            break;
            case 2:
            $this->errorFileArray[]= 2;
            break;
            case 3:
            $this->errorFileArray[]= 3;
            break;
            case 4:
            $this->errorFileArray[]= 4;
            break;
            default:
            $this->errorFileArray[]= 'unknown';
            }//end switch
        }//foreach
    }//End getErrors method

/**
 * If there is a error then the $validFileArray will have a empty Key. We need to remove this.
 * Then we will have a object loaded with the remaining successfull files.
 *
 *@return object
 */ 
    private function unsetEmptyFileArray () {
        $this->obj = new stdClass();
        foreach($this->validFileArray as $k=>$v )
        {
            for($i=0;$i<=count($v);$i++){
                if(empty($v[$i])){ unset($v[$i]); }
            }//end for
            $this->obj->$k= $v;
        }//end foreach
    }//End unsetEmptyFileArray Method
    
}//End Class