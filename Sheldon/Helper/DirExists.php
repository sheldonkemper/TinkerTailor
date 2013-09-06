<?php
namespace Sheldon\Helper;
class DirExists
{
    public function __construct ($moduleDir) 
    {
        $modDir=null;

        $moduleDir = trim($moduleDir);

        if (is_dir($moduleDir))
            {
                $this->modDir = $moduleDir;
            }
            else
            {
                throw new \Exception("Error Processing Dirname", 1);
                
            }

    }

    public function __toString()
    {
        return $this->modDir;
    }
}