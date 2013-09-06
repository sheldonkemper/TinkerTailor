<?php
/**
  *@author Venkat D
  *@site http://stackoverflow.com/questions/928928/determining-what-classes-are-defined-in-a-php-class-file
  *
  */
namespace Sheldon\Helper;

class GetClasses
{

public function __construct($php_code) {
  $classes = array();
  $tokens = token_get_all($php_code);
  $count = count($tokens);
  for ($i = 2; $i < $count; $i++) {
    if (   $tokens[$i - 2][0] == T_CLASS
        && $tokens[$i - 1][0] == T_WHITESPACE
        && $tokens[$i][0] == T_STRING) {

        $class_name = $tokens[$i][1];
        $classes[] = $class_name;
    }
  }
  return $classes;
}
}