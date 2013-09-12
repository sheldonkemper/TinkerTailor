Tinker Taylor
======

Random work which is building up towards a fully fledged project.
Not currently sure where this is going, but have at least decided to create a framework to be able to then create modules to plug in.
Most of this code has been ported from a preious project I was working on, named Tinker.

===
A recommended order to view project files(currently) to get an understanding is:  
  *  From `index.php` in root, which initializes the Router class,  
  *  This is found in `Router.php` in `\Sheldon\Router`. This class does some work, then loades the Controller.  
  *  This is found in `Controller.php` in `\Sheldon\Controller`. Currently does not do much, basically loads the Module file.  
  *  Default Module file is found in `Module\index`. This loads if a specific url parameter has not been passed, which is ?m={MOULENAME}

===
####TODO
  *  Would like to work out how to load a module as a block in any give url. 
  *  Database will prob be needed to store reference


 
===

Author: sheldonkemper  
Copyright 2013-2014 Sheldon Kemper  
License http://opensource.org/licenses/GPL-3.0



