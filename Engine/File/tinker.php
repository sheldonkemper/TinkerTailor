<?php
/**
 *@file A collection of random classes.
 *
 *@author Enginekemper
 *@copyright 2013-2014 Engine Kemper
 *@license http://opensource.org/licenses/GPL-3.0
 */
 
 
/**
 *Is a User Name
 *
 * Tests if a stored user (array) matches a user(string)
 *
 *@todo Test and make more robust to database array
 */
class isUserName
{

  private $user;
  private $storedUser; 
  private $confirmUser = 0;

/**
 *Loops over the strored user array testing if the string exists
 *
 *@return boolean
 */
 private function bool_SetUser () {
   foreach ($this->storedUser as $key=>$value) {
     if ((string)$value==(string)$this->user) {
	    (bool)$this->confirmUser = 1;
	 }else{
		(bool)$this->confirmUser = 0;
	 }
   }
 }//end method
/**
 *
 *@param string:$user
 *@param array:$dbUser
 *@return 
 */ 
  public function __construct ($user,$dbUser) {
   (string)$this->user = (string)$user;
   (array)$this->storedUser = (array)$dbUser;
    $this->bool_SetUser ();
 }//end method
 
/**
 *Confirms if the user exists
 *
 *@return boolean
 */
  public function bool_getIsUser () {
   return $this->confirmUser;
 }//end method
}////////////////////////////////////////End class/////////////////////////////////////


/**
 *Multiple File upload
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
class FileUpload
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
if($_FILES){
$DocumentRoot = $_SERVER['DOCUMENT_ROOT'];
$fileupload = new FileUpload('userfile',$DocumentRoot);

}
?>
<!--Form available for testing purposes-->
<form action="" method="post" enctype="multipart/form-data">
  Send these files:<br />
  <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="123" />
  <input name="userfile[]" type="file" /><br />
  <input name="userfile[]" type="file" /><br />
  <input type="submit" value="Send files" />
</form>

