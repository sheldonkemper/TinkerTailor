<?php
/**
  *@author Rogere Thomas
  *@site http://www.rogerethomas.com/blog/php-convert-array-to-object
  *
  */
namespace Sheldon\Helper;

class ArrayToObject {

   /*
    *
    *
    */
    public static function convert($array) {
        if(!is_array($array)) {
            return $array;
        }

        $obj = new \stdClass();
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $val = self::convert($val);
            }

            $obj->$key = $val;
        }

        return $obj;
    }

} 