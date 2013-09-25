<?php
/**
 *@author Sheldon Kemper
 *@copyright Sheldon Kemper 2013
 *
 *@file Autoload class files. 
 * 
 *@comment Not best approach. Needs work.
 */

function __autoload($class_name) {
        include $class_name . '.php';
    }   
