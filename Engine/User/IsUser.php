<?php
/**
 *@author Enginekemper
 *@copyright 2013-2014 Engine Kemper
 *@license http://opensource.org/licenses/GPL-3.0
 *
 *Is a User Name
 *
 * Tests if a stored user (array) matches a user(string)
 *
 *@todo Test and make more robust to database array
 */

namespace Engine\User;

class IsUser
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
}